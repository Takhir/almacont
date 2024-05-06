<?php

namespace App\Http\Controllers\Directory\Channels;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ChannelService;

class ImportController extends Controller
{
    private ChannelService $service;

    public function __construct(ChannelService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request)
    {
        if ($this->service->import($request->file('channels_import'))) {
            return redirect()->route('channels.index')->with('success', 'Данные успешно загружены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при загрузки данных');
    }
}
