<?php

namespace App\Http\Controllers\Directory\Packages;

use App\Http\Controllers\Controller;
use App\Services\PackageService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private PackageService $service;

    public function __construct(PackageService $service) {
        $this->service = $service;
    }

    public function __invoke(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $packages = $this->service->getAll($perPage);

        return view('directory.packages.index', compact('packages'));
    }
}
