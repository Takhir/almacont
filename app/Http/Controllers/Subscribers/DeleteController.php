<?php

namespace App\Http\Controllers\Subscribers;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use App\Services\SubscriberService;

class DeleteController extends Controller
{
    private SubscriberService $service;

    public function __construct(SubscriberService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Subscriber $subscriber)
    {
        if ($this->service->delete($subscriber)) {
            return redirect()->route('subscribers.index')->with('success', 'Данные успешно удалены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при удалении');
    }
}
