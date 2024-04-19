<?php

namespace App\Http\Controllers\Directory\Packages;

use App\Dto\PackageDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Package\StoreRequest;
use App\Services\PackageService;

class StoreController extends Controller
{
    private PackageService $service;

    public function __construct(PackageService $service)
    {
        $this->service = $service;
    }

    public function __invoke(StoreRequest $request)
    {
        $validated = $request->validated();

        $packageDTO = new PackageDTO(
            $validated['name'],
            $validated['description'],
            $validated['active'],
        );

        if ($this->service->store($packageDTO)) {
            return redirect()->route('packages.index')->with('success', 'Данные успешно сохранены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при сохранении');
    }
}
