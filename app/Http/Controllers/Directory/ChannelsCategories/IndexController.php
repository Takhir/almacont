<?php

namespace App\Http\Controllers\Directory\ChannelsCategories;

use App\Http\Controllers\Controller;
use App\Services\ChannelCategoryService;
use App\Services\ChannelService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private ChannelCategoryService $service;

    public function __construct(ChannelCategoryService $service) {
        $this->service = $service;
    }

    public function __invoke(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $categories = $this->service->all($perPage);

        return view('directory.channels-categories.index', compact('categories'));
    }
}
