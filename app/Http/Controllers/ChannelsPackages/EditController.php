<?php

namespace App\Http\Controllers\ChannelsPackages;

use App\Http\Controllers\Controller;
use App\Models\ChannelsPackage;
use App\Services\ChannelService;
use App\Services\DepartmentService;
use App\Services\PackageService;
use App\Services\TownService;

class EditController extends Controller
{
    private ChannelService $channelService;
    private PackageService $packageService;
    private DepartmentService $departmentService;
    private TownService $townService;

    public function __construct(ChannelService $channelService, PackageService $packageService, DepartmentService $departmentService, TownService $townService)
    {
        $this->channelService = $channelService;
        $this->packageService = $packageService;
        $this->departmentService = $departmentService;
        $this->townService = $townService;
    }
    public function __invoke(ChannelsPackage $channelsPackage)
    {
        $channels = $this->channelService->all();
        $packages = $this->packageService->all();
        $departments = $this->departmentService->all();
        $towns = $this->townService->all();

        return view('channels-packages.edit', compact('channelsPackage', 'channels', 'packages', 'departments', 'towns'));
    }
}
