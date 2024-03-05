<?php

namespace App\Http\Controllers\Directory\Periods;

use App\Http\Controllers\Controller;
use App\Http\Requests\Period\UpdateRequest;
use App\Models\Period;
use App\Services\PeriodService;

class UpdateController extends Controller
{
    private PeriodService $service;

    public function __construct(PeriodService $service)
    {
        $this->service = $service;
    }

    public function __invoke(UpdateRequest $request, Period $period)
    {
        if ($this->service->update($request, $period)) {
            return redirect()->route('periods.index')->with('success', 'Данные успешно обновлены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при обновлении');
    }
}
