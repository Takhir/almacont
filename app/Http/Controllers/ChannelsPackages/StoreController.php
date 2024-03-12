<?php

namespace App\Http\Controllers\ChannelsPackages;

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
        if ($this->service->store($request)) {
            return redirect()->route('channels-packages.index')->with('success', 'Данные успешно сохранены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при сохранении');
    }
}
