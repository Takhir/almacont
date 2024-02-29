<?php

namespace App\Http\Controllers\Directory\ChannelsCategories;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChannelCategory\UpdateRequest;
use App\Models\ChannelCategory;
use App\Services\ChannelCategoryService;

class UpdateController extends Controller
{
    private ChannelCategoryService $service;

    public function __construct(ChannelCategoryService $service)
    {
        $this->service = $service;
    }

    public function __invoke(UpdateRequest $request, ChannelCategory $category)
    {
        if ($this->service->update($request, $category)) {
            return redirect()->route('channels-categories.index')->with('success', 'Данные успешно обновлены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при обновлении');
    }
}
