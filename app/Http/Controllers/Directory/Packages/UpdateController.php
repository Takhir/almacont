<?php

namespace App\Http\Controllers\Directory\Packages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Package\UpdateRequest;
use App\Models\Package;
use App\Services\PackageService;

class UpdateController extends Controller
{
    private PackageService $service;

    public function __construct(PackageService $service)
    {
        $this->service = $service;
    }

    public function __invoke(UpdateRequest $request, Package $package)
    {
        if ($this->service->update($request, $package)) {
            return redirect()->route('packages.index')->with('success', 'Данные успешно обновлены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при обновлении');
    }
}
