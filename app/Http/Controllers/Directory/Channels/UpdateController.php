<?php

namespace App\Http\Controllers\Directory\Channels;

use App\Http\Controllers\Controller;
use App\Http\Requests\Counterparty\UpdateRequest;
use App\Models\Channel;
use App\Services\ChannelService;

class UpdateController extends Controller
{
    private ChannelService $service;

    public function __construct(ChannelService $service)
    {
        $this->service = $service;
    }

    public function __invoke(UpdateRequest $request, Channel $channel)
    {
        if ($this->service->update($request, $channel)) {
            return redirect()->route('channels.index')->with('success', 'Данные успешно обновлены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при обновлении');
    }
}
