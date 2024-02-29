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
        $perPage = $request->input('per_page', 20);
        $channels = $this->service->getAll($perPage);

        return view('directory.channels.index', compact('channels'));
    }
}
