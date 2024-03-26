<?php

namespace App\Http\Controllers\Directory\ChannelsCategories;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\ChannelCategory;
use App\Services\ChannelCategoryService;
use App\Services\ChannelService;

class DeleteController extends Controller
{
    private ChannelCategoryService $service;

    public function __construct(ChannelCategoryService $service)
    {
        $this->service = $service;
    }

    public function __invoke(ChannelCategory $category)
    {
        if ($this->service->delete($category)) {
            return redirect()->route('channels-categories.index')->with('success', 'Данные успешно удалены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при удалении');
    }
}
