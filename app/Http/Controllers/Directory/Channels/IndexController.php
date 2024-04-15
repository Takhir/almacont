<?php

namespace App\Http\Controllers\Directory\Channels;

use App\Http\Controllers\Controller;
use App\Services\ChannelService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private ChannelService $service;

    public function __construct(ChannelService $service) {
        $this->service = $service;
    }

    public function __invoke(Request $request)
    {
        $channelsFilter = $this->service->all();
        $channels = $this->service->getAll($request);

        return view('directory.channels.index', compact('channelsFilter', 'channels'));
    }
}
