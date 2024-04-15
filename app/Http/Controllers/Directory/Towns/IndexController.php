<?php

namespace App\Http\Controllers\Directory\Towns;

use App\Http\Controllers\Controller;
use App\Services\TownService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private TownService $service;

    public function __construct(TownService $service) {
        $this->service = $service;
    }
    public function __invoke($departmentId)
    {
        return $this->service->getTowns($departmentId);
    }
}
