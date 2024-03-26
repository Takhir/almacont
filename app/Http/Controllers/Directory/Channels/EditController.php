<?php

namespace App\Http\Controllers\Directory\Channels;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Services\ChannelCategoryService;

class EditController extends Controller
{
    private ChannelCategoryService $categoryService;

    public function __construct(ChannelCategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }

    public function __invoke(Channel $channel)
    {
        $categories = $this->categoryService->getAll();

        return view('directory.channels.edit', compact('channel', 'categories'));
    }
}
