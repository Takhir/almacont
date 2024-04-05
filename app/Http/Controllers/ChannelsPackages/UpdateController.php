<?php

namespace App\Http\Controllers\ChannelsPackages;

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
        if ($this->service->update($request, $channelsPackage)) {
            return redirect()->route('channels-packages.index')->with('success', 'Данные успешно обновлены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при обновлении');
    }
}
