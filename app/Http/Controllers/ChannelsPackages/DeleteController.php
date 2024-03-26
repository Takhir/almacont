<?php

namespace App\Http\Controllers\ChannelsPackages;

use App\Http\Controllers\Controller;
use App\Models\ChannelsPackage;
use App\Services\ChannelsPackageService;

class DeleteController extends Controller
{
    private ChannelsPackageService $service;

    public function __construct(ChannelsPackageService $service)
    {
        $this->service = $service;
    }

    public function __invoke(ChannelsPackage $channelsPackage)
    {
        if ($this->service->delete($channelsPackage)) {
            return redirect()->route('channels-packages.index')->with('success', 'Данные успешно удалены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при удалении');
    }
}
