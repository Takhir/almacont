<?php

namespace App\Http\Controllers\ChannelsPackages;

use App\Dto\ChannelsPackageFilterDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChannelsPackage\IndexRequest;
use App\Services\ChannelsPackageService;
use App\Services\ChannelService;
use App\Services\DepartmentService;
use App\Services\PackageService;

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

    public function __invoke(IndexRequest $request)
    {
        $validated = $request->validated();

        $channelsPackageFilterDTO = new ChannelsPackageFilterDTO(
            20,
            $validated['channel_id'] ?? null,
            $validated['category_id'] ?? null,
            $validated['package_id'] ?? null,
            $validated['department_id'] ?? null,
            $validated['town_id'] ?? null,
            $validated['dt_start_from'] ?? null,
            $validated['dt_start_to'] ?? null,
            $validated['dt_end_from'] ?? null,
            $validated['dt_end_to'] ?? null,
        );

        $channelsPackages = $this->service->getAll($channelsPackageFilterDTO);
        $channels = $this->channelService->all();
        $packages = $this->packageService->all();
        $departments = $this->departmentService->all();

        return view('channels-packages.index', compact('channelsPackages', 'channels', 'packages', 'departments'));
    }
}
