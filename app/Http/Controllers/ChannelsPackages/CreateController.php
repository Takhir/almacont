<?php

namespace App\Http\Controllers\ChannelsPackages;

use App\Http\Controllers\Controller;
use App\Services\ChannelService;
use App\Services\DepartmentService;
use App\Services\PackageService;

class CreateController extends Controller
{
    private ChannelService $channelService;
    private PackageService $packageService;
    private DepartmentService $departmentService;

    public function __construct(ChannelService $channelService, PackageService $packageService, DepartmentService $departmentService)
    {
        $this->channelService = $channelService;
        $this->packageService = $packageService;
        $this->departmentService = $departmentService;
    }
    public function __invoke()
    {
        $channels = $this->channelService->all();
        $packages = $this->packageService->all();
        $departments = $this->departmentService->all();

        return view('channels-packages.create', compact('channels', 'packages', 'departments'));
    }
}
