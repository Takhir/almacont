<?php

namespace App\Repositories;

use App\Dto\ChannelsPackageDTO;
use App\Models\AgreementsCard;
use App\Models\ChannelsPackage;
use App\Models\Currency;
use Carbon\Carbon;

class ChannelsPackageRepository
{
    public function getAll($request)
    {
        $perPage = $request->input('per_page', 20);
        $channelId = $request->input('channel_id');
        $packageId = $request->input('package_id');
        $departmentId = $request->input('department_id');
        $townId = $request->input('town_id');
        $dtStartFrom = $request->input('dt_start_from');
        $dtStartTo = $request->input('dt_start_to');
        $dtStopFrom = $request->input('dt_stop_from');
        $dtStopTo = $request->input('dt_stop_to');

        $query = ChannelsPackage::with('channel')
            ->with('package')
            ->with('department')
            ->with('town')
            ->orderBy('id', 'desc');

        if ($channelId) {
            $query->whereIn('channel_id', $channelId);
        }

        if ($packageId) {
            $query->whereIn('package_id', $packageId);
        }

        if ($departmentId) {
            $query->whereIn('department_id', $departmentId);
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

        return $query->paginate($perPage);
    }

    public function store($request)
    {
        $channelsPackageDto = $this->dto($request);

        $channelsPackage = new ChannelsPackage();
        $channelsPackage->channel_id = $channelsPackageDto->channel_id;
        $channelsPackage->package_id = $channelsPackageDto->package_id;
        $channelsPackage->department_id = $channelsPackageDto->department_id;
        $channelsPackage->town_id = $channelsPackageDto->town_id;
        $channelsPackage->dt_start = $channelsPackageDto->dt_start;
        $channelsPackage->dt_stop = $channelsPackageDto->dt_stop;

        return $channelsPackage->save();
    }

    public function update($request, $channelsPackage)
    {
        $channelsPackageDto = $this->dto($request);

        $channelsPackage->channel_id = $channelsPackage->channel_id;
        $channelsPackage->package_id = $channelsPackageDto->package_id;
        $channelsPackage->department_id = $channelsPackageDto->department_id;
        $channelsPackage->town_id = $channelsPackageDto->town_id;
        $channelsPackage->dt_start = $channelsPackageDto->dt_start;
        $channelsPackage->dt_stop = $channelsPackageDto->dt_stop;

        return $channelsPackage->save();
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
            $request->input('department_id'),
            $request->input('town_id'),
            $request->input('dt_start'),
            $request->input('dt_stop'),
        );
    }
}
