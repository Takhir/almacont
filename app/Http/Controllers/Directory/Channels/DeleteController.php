<?php

namespace App\Http\Controllers\Directory\Channels;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Services\ChannelService;

class DeleteController extends Controller
{
    private ChannelService $service;

    public function __construct(ChannelService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Channel $channel)
    {
        if ($this->service->delete($channel)) {
            return redirect()->route('channels.index')->with('success', 'Данные успешно удалены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при удалении');
    }
}
