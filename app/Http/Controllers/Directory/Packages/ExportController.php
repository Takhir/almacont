<?php

namespace App\Http\Controllers\Directory\Packages;

use App\Http\Controllers\Controller;
use App\Services\PackageService;

class ExportController extends Controller
{
    private PackageService $service;

    public function __construct(PackageService $service)
    {
        $this->service = $service;
    }

    public function __invoke()
    {
        $file = $this->service->export();

        if ($file) {
            $filePath = storage_path('app/public/' . $file);

            if (file_exists($filePath)) {
                return response()->download($filePath)->deleteFileAfterSend(true);
            }
            return redirect()->back()->with('error', 'Произошла ошибка при выгрузки данных');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при выгрузки данных');
    }
}
