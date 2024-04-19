<?php

namespace App\Repositories;

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

    public function store($channelsPackageDTO)
    {
        $data = [
            [
                'channel_id' => $channelsPackageDTO->channel_id,
                'package_id' => $channelsPackageDTO->package_id,
                'all_department' => $channelsPackageDTO->all_department,
                'department_id' => $channelsPackageDTO->department_id,
                'town_id' => $channelsPackageDTO->town_id,
                'dt_start' => $channelsPackageDTO->dt_start,
                'dt_stop' => $channelsPackageDTO->dt_stop,
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

        foreach ($result as $fields) {

            if(isset($fields['all_department']))
            {
                $this->saveForAllDepartments($fields);
            }

            $this->saveChannelsPackage(new ChannelsPackage(), $fields);
        }

        return true;
    }

    public function update(array $fields, ChannelsPackage $channelsPackage)
    {
        if(isset($fields['all_department']))
        {
            $this->delete($channelsPackage);

            return $this->saveForAllDepartments($fields);
        }

        return $this->saveChannelsPackage($channelsPackage, $fields);
    }

    public function delete(ChannelsPackage $channelsPackage)
    {
        return $channelsPackage->delete();
    }

    public function saveChannelsPackage($channelsPackage, array $fields)
    {
        $channelsPackage->channel_id = $fields['channel_id'];
        $channelsPackage->package_id = $fields['package_id'];
        $channelsPackage->department_id = $fields['department_id'];
        $channelsPackage->town_id = $fields['town_id'];
        $channelsPackage->dt_start = $fields['dt_start'];
        $channelsPackage->dt_stop = $fields['dt_stop'];

        if($this->townRepository->existTown($channelsPackage->department_id, $channelsPackage->town_id))
            return $channelsPackage->save();

        return true;
    }

    public function saveForAllDepartments(array $fields)
    {
        $departments = $this->departmentRepository->all();
        foreach ($departments as $department) {

            $fields['department_id'] = $department->department_id;
            $fields['town_id'] = $department->town_id;

            $this->saveChannelsPackage(new ChannelsPackage(), $fields);
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
