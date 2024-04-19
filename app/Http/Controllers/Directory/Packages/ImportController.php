<?php

namespace App\Http\Controllers\Directory\Packages;

use App\Http\Controllers\Controller;
use App\Services\PackageService;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    private PackageService $service;

    public function __construct(PackageService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request)
    {
        if ($this->service->import($request->file('packages_import'))) {
            return redirect()->route('packages.index')->with('success', 'Данные успешно загружены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при загрузки данных');
    }
}
