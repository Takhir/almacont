<?php

namespace App\Http\Controllers\FillingPackages;

use App\Http\Controllers\Controller;
use App\Services\ChannelCategoryService;
use App\Services\ChannelService;
use App\Services\ChannelsPackageService;
use App\Services\DepartmentService;
use App\Services\PackageService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private ChannelsPackageService $service;
    private ChannelService $channelService;
    private ChannelCategoryService $channelCategoryService;
    private PackageService $packageService;
    private DepartmentService $departmentService;

    public function __construct(ChannelsPackageService $service, ChannelService $channelService, ChannelCategoryService $channelCategoryService, PackageService $packageService, DepartmentService $departmentService)
    {
        $this->service = $service;
        $this->channelService = $channelService;
        $this->channelCategoryService = $channelCategoryService;
        $this->packageService = $packageService;
        $this->departmentService = $departmentService;
    }

    public function __invoke(Request $request)
    {
        $channelsPackages = count($request->all()) > 0 ? $this->service->getFilling($request) : [];
        $channels = $this->channelService->all();
        $categories = $this->channelCategoryService->getAll();
        $packages = $this->packageService->all();
        $departments = $this->departmentService->all();

        return view('filling-packages.index', compact('channelsPackages', 'channels', 'categories', 'packages', 'departments'));
    }
}
