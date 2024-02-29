<?php

namespace App\Http\Controllers\Directory\Periods;

use App\Http\Controllers\Controller;
use App\Services\PeriodService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private PeriodService $service;

    public function __construct(PeriodService $service) {
        $this->service = $service;
    }

    public function __invoke(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $periods = $this->service->all($perPage);

        return view('directory.periods.index', compact('periods'));
    }
}
