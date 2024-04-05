<?php

namespace App\Http\Controllers\Directory\Periods;

use App\Http\Controllers\Controller;
use App\Http\Requests\Period\StoreRequest;
use App\Services\PeriodService;

class StoreController extends Controller
{
    private PeriodService $service;

    public function __construct(PeriodService $service)
    {
        $this->service = $service;
    }

    public function __invoke(StoreRequest $request)
    {
        if ($this->service->store($request)) {
            return redirect()->route('periods.index')->with('success', 'Данные успешно сохранены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при сохранении');
    }
}
