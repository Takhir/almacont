<?php

namespace App\Http\Controllers\ChannelsPackages;

use App\Http\Controllers\Controller;
use App\Services\ChannelsPackageService;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    private ChannelsPackageService $service;

    public function __construct(ChannelsPackageService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request)
    {
        if ($this->service->import($request->file('channels_packages_import'))) {
            return redirect()->route('channels-packages.index')->with('success', 'Данные успешно загружены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при загрузки данных');
    }
}
