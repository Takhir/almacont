<?php

namespace App\Http\Controllers\Directory\Departments;

use App\Http\Controllers\Controller;
use App\Services\DepartmentService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private DepartmentService $service;

    public function __construct(DepartmentService $service) {
        $this->service = $service;
    }
    public function __invoke(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $departments = $this->service->getAll($perPage);

        return view('directory.departments.index', compact('departments'));
    }
}
