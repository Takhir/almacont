<?php

namespace App\Repositories;

use App\Dto\ChannelsPackageDTO;
use App\Exports\ChannelsPackageExport;
use App\Imports\ChannelsPackageImport;
use App\Models\ChannelsPackage;
use Maatwebsite\Excel\Facades\Excel;

class ChannelsPackageRepository
{
    private DepartmentRepository $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function channelsPackage($request)
    {
        $channelId = $request->input('channel_id');
        $categoryId = $request->input('category_id');
        $packageId = $request->input('package_id');
        $departmentId = $request->input('department_id');
        $townId = $request->input('town_id');
        $dtStartFrom = $request->input('dt_start_from');
        $dtStartTo = $request->input('dt_start_to');
        $dtStopFrom = $request->input('dt_stop_from');
        $dtStopTo = $request->input('dt_stop_to');

        $query = ChannelsPackage::join('channels', 'channels.id', '=', 'channels_packages.channel_id')
            ->join('packages', 'packages.id', '=', 'channels_packages.package_id')
            ->join('departments', 'departments.department_id', '=', 'channels_packages.department_id')
            ->with('town')
            ->orderBy('channels.name')
            ->orderBy('departments.department')
            ->orderBy('packages.name');

        if ($channelId) {
            $query->whereIn('channel_id', $channelId);
        }

        if ($categoryId) {
            $query = $query->whereHas('channel', function ($query) use ($categoryId) {
                $query->whereIn('category_id', $categoryId);
            });
        }

        if ($packageId) {
            $query->whereIn('package_id', $packageId);
        }

        if ($departmentId) {
            $query->whereIn('channels_packages.department_id', $departmentId);
        }

        if ($townId) {
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

    public function getFilling($request)
    {
        $perPage = $request->input('per_page', 20);
        $query = $this->channelsPackage($request);

        $query->whereHas('package', function ($query) {
            $query->where('active', 1);
        })->whereNull('dt_stop');

        return $query->paginate($perPage);
    }

    public function getAll($request)
    {
        $perPage = $request->input('per_page', 20);
        $query = $this->channelsPackage($request);

        return $query->paginate($perPage);
    }

    public function store($request)
    {
        $channelsPackageDto = $this->dto($request);

        if(isset($channelsPackageDto->all_department))
        {
            return $this->saveForAllDepartments($channelsPackageDto);
        }

        return $this->saveChannelsPackage(new ChannelsPackage(), $channelsPackageDto);
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

    public function delete($channelsPackage)
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

        return $channelsPackage->save();
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

    public function import($request)
    {
        return Excel::import(new ChannelsPackageImport, $request->file('channels_packages_import'));
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
