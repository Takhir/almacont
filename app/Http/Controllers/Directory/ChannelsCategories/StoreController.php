<?php

namespace App\Http\Controllers\Directory\ChannelsCategories;

use App\Dto\ChannelCategoryDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChannelCategory\StoreRequest;
use App\Services\ChannelCategoryService;

class StoreController extends Controller
{
    private ChannelCategoryService $service;

    public function __construct(ChannelCategoryService $service)
    {
        $this->service = $service;
    }

    public function __invoke(StoreRequest $request)
    {
        $validated = $request->validated();
        $channelCategoryDTO = new ChannelCategoryDTO($validated['name']);

        if ($this->service->store($channelCategoryDTO)) {
            return redirect()->route('channels-categories.index')->with('success', 'Данные успешно сохранены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при сохранении');
    }
}
