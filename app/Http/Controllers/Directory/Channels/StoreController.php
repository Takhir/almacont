<?php

namespace App\Http\Controllers\Directory\Channels;

use App\Http\Controllers\Controller;
use App\Http\Requests\Channel\StoreRequest;
use App\Services\ChannelService;

class StoreController extends Controller
{
    private ChannelService $service;

    public function __construct(ChannelService $service)
    {
        $this->service = $service;
    }

    public function __invoke(StoreRequest $request)
    {
        if ($this->service->store($request)) {
            return redirect()->route('channels.index')->with('success', 'Данные успешно сохранены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при сохранении');
    }
}
