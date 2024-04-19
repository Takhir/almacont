<?php

namespace App\Http\Controllers\FillingPackages;

use App\Dto\ChannelsPackageFilterDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChannelsPackage\IndexRequest;
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

        $channelsPackages = count($request->all()) > 0 ? $this->service->getFilling($channelsPackageFilterDTO) : [];
        $channels = $this->channelService->all();
        $categories = $this->channelCategoryService->getAll();
        $packages = $this->packageService->all();
        $departments = $this->departmentService->all();

        return view('filling-packages.index', compact('channelsPackages', 'channels', 'categories', 'packages', 'departments'));
    }
}
