<?php

namespace App\Http\Controllers\ChannelsPackages;

use App\Http\Controllers\Controller;
use App\Services\ChannelsPackageService;
use App\Services\ChannelService;
use App\Services\DepartmentService;
use App\Services\PackageService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private ChannelsPackageService $service;
    private ChannelService $channelService;
    private PackageService $packageService;
    private DepartmentService $departmentService;


    public function __construct(ChannelsPackageService $service, ChannelService $channelService, PackageService $packageService, DepartmentService $departmentService)
    {
        $this->service = $service;
        $this->channelService = $channelService;
        $this->packageService = $packageService;
        $this->departmentService = $departmentService;
    }

    public function __invoke(Request $request)
    {
        $channelsPackages = $this->service->getAll($request);
        $channels = $this->channelService->all();
        $packages = $this->packageService->all();
        $departments = $this->departmentService->all();

        return view('channels-packages.index', compact('channelsPackages', 'channels', 'packages', 'departments'));
    }
}
