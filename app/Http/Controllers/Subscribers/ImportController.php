<?php

namespace App\Http\Controllers\Subscribers;

use App\Http\Controllers\Controller;
use App\Services\SubscriberService;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    private SubscriberService $service;

    public function __construct(SubscriberService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request)
    {
        if ($this->service->import($request->file('subscribers_import'))) {
            return redirect()->route('subscribers.index')->with('success', 'Данные успешно загружены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при загрузки данных');
    }
}
