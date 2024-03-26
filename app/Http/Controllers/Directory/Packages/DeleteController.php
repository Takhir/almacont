<?php

namespace App\Http\Controllers\Directory\Packages;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Services\PackageService;

class DeleteController extends Controller
{
    private PackageService $service;

    public function __construct(PackageService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Package $package)
    {
        if ($this->service->delete($package)) {
            return redirect()->route('packages.index')->with('success', 'Данные успешно удалены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при удалении');
    }
}
