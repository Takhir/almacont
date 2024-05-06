<?php

namespace App\Http\Controllers\Calculations;

use App\Http\Controllers\Controller;
use App\Services\SubscribersOnChannelService;
use Illuminate\Http\Request;

class SubscribersOnChannelExportController extends Controller
{
    private SubscribersOnChannelService $subscriberService;

    public function __construct(SubscribersOnChannelService $subscriberService)
    {
        $this->subscriberService = $subscriberService;
    }

    public function __invoke(Request $request)
    {
        $file = $this->subscriberService->subscribersExport($request->get('period_id'));

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
