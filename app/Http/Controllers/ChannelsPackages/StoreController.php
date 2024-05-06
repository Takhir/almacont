<?php

namespace App\Http\Controllers\ChannelsPackages;

use App\Dto\ChannelsPackageDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChannelsPackage\StoreRequest;
use App\Services\ChannelsPackageService;

class StoreController extends Controller
{
    private ChannelsPackageService $service;

    public function __construct(ChannelsPackageService $service)
    {
        $this->service = $service;
    }

    public function __invoke(StoreRequest $request)
    {
        $validated = $request->validated();

        $channelsPackageDTO = new ChannelsPackageDTO(
            $validated['channel_id'],
            $validated['package_id'],
            $validated['all_department'] ?? null,
            $validated['department_id'] ?? null,
            $validated['town_id'] ?? null,
            $validated['dt_start'] ?? null,
            $validated['dt_stop'] ?? null,
        );

        if ($this->service->store($channelsPackageDTO)) {
            return redirect()->route('channels-packages.index')->with('success', 'Данные успешно сохранены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при сохранении');
    }
}
