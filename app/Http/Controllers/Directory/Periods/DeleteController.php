<?php

namespace App\Http\Controllers\Directory\Periods;

use App\Http\Controllers\Controller;
use App\Models\Period;
use App\Services\PeriodService;

class DeleteController extends Controller
{
    private PeriodService $service;

    public function __construct(PeriodService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Period $period)
    {
        if ($this->service->delete($period)) {
            return redirect()->route('periods.index')->with('success', 'Данные успешно удалены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при удалении');
    }
}
