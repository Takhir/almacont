<?php

namespace App\Http\Controllers\ChannelsPackages;

use App\Http\Controllers\Controller;
use App\Services\ChannelsPackageService;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    private ChannelsPackageService $service;

    public function __construct(ChannelsPackageService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request)
    {
        $file = $this->service->export($request);

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
