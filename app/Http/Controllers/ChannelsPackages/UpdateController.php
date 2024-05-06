<?php

namespace App\Http\Controllers\ChannelsPackages;

use App\Dto\ChannelsPackageUpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChannelsPackage\UpdateRequest;
use App\Models\ChannelsPackage;
use App\Services\ChannelsPackageService;

class UpdateController extends Controller
{
    private ChannelsPackageService $service;

    public function __construct(ChannelsPackageService $service)
    {
        $this->service = $service;
    }

    public function __invoke(UpdateRequest $request, ChannelsPackage $channelsPackage)
    {
        $validated = $request->validated();

        $channelsPackageDTO = new ChannelsPackageUpdateDTO(
            $validated['channel_id'],
            $validated['package_id'],
            $validated['all_department'] ?? null,
            $validated['department_id'] ?? null,
            $validated['town_id'] ?? null,
            $validated['dt_start'] ?? null,
            $validated['dt_stop'] ?? null,
        );

        if ($this->service->update((array) $channelsPackageDTO, $channelsPackage)) {
            return redirect()->route('channels-packages.index')->with('success', 'Данные успешно обновлены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при обновлении');
    }
}
