<?php

namespace App\Http\Controllers\Subscribers;

use App\Http\Controllers\Controller;
use App\Services\DepartmentService;
use App\Services\PeriodService;
use App\Services\SubscriberService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private SubscriberService $service;
    private PeriodService $periodService;
    private DepartmentService $departmentService;

    public function __construct(SubscriberService $service, PeriodService $periodService, DepartmentService $departmentService)
    {
        $this->service = $service;
        $this->periodService = $periodService;
        $this->departmentService = $departmentService;
    }

    public function __invoke(Request $request)
    {
        $subscribers = $this->service->getAll($request);
        $periods = $this->periodService->getAll();
        $towns = $this->departmentService->getTowns();
        $packages = $this->service->getServices();

        return view('subscribers.index', compact('subscribers', 'periods', 'towns', 'packages'));
    }
}
