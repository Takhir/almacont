<?php

namespace App\Repositories;

use App\Dto\ChannelsPackageDTO;
use App\Exports\ChannelsPackageExport;
use App\Imports\ChannelsPackageImport;
use App\Models\ChannelsPackage;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ChannelsPackageRepository
{
    private DepartmentRepository $departmentRepository;
    private TownRepository $townRepository;

    public function __construct(DepartmentRepository $departmentRepository, TownRepository $townRepository)
    {
        $this->departmentRepository = $departmentRepository;
        $this->townRepository = $townRepository;
    }

    public function channelsPackage($channelsPackageFilterDTO)
    {
        $channelId = $channelsPackageFilterDTO->channel_id;
        $categoryId = $channelsPackageFilterDTO->category_id;
        $packageId = $channelsPackageFilterDTO->package_id;
        $departmentId = $channelsPackageFilterDTO->department_id;
        $townId = $channelsPackageFilterDTO->town_id;
        $dtStartFrom = $channelsPackageFilterDTO->dt_start_from;
        $dtStartTo = $channelsPackageFilterDTO->dt_start_to;
        $dtStopFrom = $channelsPackageFilterDTO->dt_stop_from;
        $dtStopTo = $channelsPackageFilterDTO->dt_stop_to;

        $query = ChannelsPackage::join('channels', 'channels.id', '=', 'channels_packages.channel_id')
            ->join('packages', 'packages.id', '=', 'channels_packages.package_id')
            ->join('departments', 'departments.id', '=', 'channels_packages.department_id')
            ->join('towns', 'towns.id', '=', 'channels_packages.town_id')
            ->select('channels_packages.*', 'channels.name as channelName', 'departments.name as departmentName', 'towns.name as townName', 'packages.name as packageName')
            ->orderBy('channels.name')
            ->orderBy('departments.name')
            ->orderBy('towns.name')
            ->orderBy('packages.name');

        if (isset($channelId[0])) {
            $query->whereIn('channel_id', $channelId);
        }

        if (isset($categoryId[0])) {
            $query = $query->whereHas('channel', function ($query) use ($categoryId) {
                $query->whereIn('category_id', $categoryId);
            });
        }

        if (isset($packageId[0])) {
            $query->whereIn('package_id', $packageId);
        }

        if (isset($departmentId[0])) {
            $query->whereIn('channels_packages.department_id', $departmentId);
        }

        if (isset($townId[0])) {
            $query->whereIn('town_id', $townId);
        }

        if ($dtStartFrom && $dtStartTo) {
            $query->whereBetween('dt_start', [$dtStartFrom, $dtStartTo]);
        } elseif($dtStartFrom && !$dtStartTo) {
            $query->whereDate('dt_start', '>=', $dtStartFrom);
        } elseif(!$dtStartFrom && $dtStartTo) {
            $query->whereDate('dt_start', '<=', $dtStartTo);
        }

        if ($dtStopFrom && $dtStopTo) {
            $query->whereBetween('dt_stop', [$dtStopFrom, $dtStopTo]);
        } elseif($dtStopFrom && !$dtStopTo) {
            $query->whereDate('dt_stop', '>=', $dtStopFrom);
        } elseif(!$dtStopFrom && $dtStopTo) {
            $query->whereDate('dt_stop', '<=', $dtStopTo);
        }

        return $query;
    }

    public function getFilling($channelsPackageFilterDTO)
    {
        $query = $this->channelsPackage($channelsPackageFilterDTO);

        $query->whereHas('package', function ($query) {
            $query->where('active', 1);
        });

        $currentDate = Carbon::now()->startOfDay();

        $query->whereDate('dt_start', '<=', $currentDate)
        ->where(function ($query) use ($currentDate) {
            $query->whereDate('dt_stop', '>=', $currentDate)
                ->orWhereNull('dt_stop');
        });

        return $query->paginate($channelsPackageFilterDTO->per_page);
    }

    public function getAll($channelsPackageFilterDTO)
    {
        $query = $this->channelsPackage($channelsPackageFilterDTO);

        return $query->paginate($channelsPackageFilterDTO->per_page);
    }

    public function store($request)
    {
        $data = [
            [
                'channel_id' => $request->input('channel_id'),
                'package_id' => $request->input('package_id'),
                'all_department' => $request->input('all_department'),
                'department_id' => $request->input('department_id'),
                'town_id' => $request->input('town_id'),
                'dt_start' => $request->input('dt_start'),
                'dt_stop' => $request->input('dt_stop'),
            ]
        ];

        $result = [];

        foreach ($data as $item) {
            $channelId = $item['channel_id'];
            $allDepartment = $item['all_department'];
            $dtStart = $item['dt_start'];
            $dtStop = $item['dt_stop'];

            $packageIds = $item['package_id'];
            $departmentIds = $item['department_id'];
            $townIds = $item['town_id'];

            foreach ($packageIds as $packageId) {
                foreach ($departmentIds as $departmentId) {
                    foreach ($townIds as $townId) {
                        $result[] = [
                            'channel_id' => $channelId,
                            'all_department' => $allDepartment,
                            'dt_start' => $dtStart,
                            'dt_stop' => $dtStop,
                            'package_id' => $packageId,
                            'department_id' => $departmentId,
                            'town_id' => $townId,
                        ];
                    }
                }
            }
        }

        foreach ($result as $v) {
            $channelsPackageDto = new ChannelsPackageDTO(
                $v['channel_id'],
                $v['package_id'],
                $v['all_department'],
                $v['department_id'],
                $v['town_id'],
                $v['dt_start'],
                $v['dt_stop'],
            );

            if(isset($channelsPackageDto->all_department))
            {
                $this->saveForAllDepartments($channelsPackageDto);
            }

            $this->saveChannelsPackage(new ChannelsPackage(), $channelsPackageDto);
        }

        return true;
    }

    public function update($request, $channelsPackage)
    {
        $channelsPackageDto = $this->dto($request);

        if(isset($channelsPackageDto->all_department))
        {
            $this->delete($channelsPackage);

            return $this->saveForAllDepartments($channelsPackageDto);
        }

        return $this->saveChannelsPackage($channelsPackage, $channelsPackageDto);
    }

    public function delete(ChannelsPackage $channelsPackage)
    {
        return $channelsPackage->delete();
    }

    public function dto($request)
    {
        return new ChannelsPackageDTO(
            $request->input('channel_id'),
            $request->input('package_id'),
            $request->input('all_department'),
            $request->input('department_id'),
            $request->input('town_id'),
            $request->input('dt_start'),
            $request->input('dt_stop'),
        );
    }

    public function saveChannelsPackage($channelsPackage, $channelsPackageDto)
    {
        $channelsPackage->channel_id = $channelsPackageDto->channel_id;
        $channelsPackage->package_id = $channelsPackageDto->package_id;
        $channelsPackage->department_id = $channelsPackageDto->department_id;
        $channelsPackage->town_id = $channelsPackageDto->town_id;
        $channelsPackage->dt_start = $channelsPackageDto->dt_start;
        $channelsPackage->dt_stop = $channelsPackageDto->dt_stop;

        if($this->townRepository->existTown($channelsPackage->department_id, $channelsPackage->town_id))
            return $channelsPackage->save();

        return true;
    }

    public function saveForAllDepartments($channelsPackageDto)
    {
        $departments = $this->departmentRepository->all();
        foreach ($departments as $department) {
            $channelsPackageDto->department_id = $department->department_id;
            $channelsPackageDto->town_id = $department->town_id;

            $this->saveChannelsPackage(new ChannelsPackage(), $channelsPackageDto);
        }

        return true;
    }

    public function import($file)
    {
        return Excel::import(new ChannelsPackageImport, $file);
    }

    public function export($request)
    {
        $export = new ChannelsPackageExport($request);
        $fileName = 'channels-packages.xlsx';
        $filePath = 'public/' . $fileName;

        Excel::store($export, $filePath);

        return $fileName;
    }
}
