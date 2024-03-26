<?php

namespace App\Http\Controllers\Directory\Channels;

use App\Http\Controllers\Controller;
use App\Services\ChannelService;

class ExportController extends Controller
{
    private ChannelService $service;

    public function __construct(ChannelService $service)
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
