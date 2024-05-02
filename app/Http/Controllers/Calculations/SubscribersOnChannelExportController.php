<?php

namespace App\Http\Controllers\Calculations;

use App\Http\Controllers\Controller;
use App\Services\SubscriberService;
use Illuminate\Http\Request;

class SubscribersOnChannelExportController extends Controller
{
    private SubscriberService $subscriberService;

    public function __construct(SubscriberService $subscriberService)
    {
        $this->subscriberService = $subscriberService;
    }

    public function __invoke($periodId)
    {
        $file = $this->subscriberService->subscribersExport($periodId);

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
