<?php

namespace App\Http\Controllers\Directory\Channels;

use App\Http\Controllers\Controller;
use App\Services\ChannelCategoryService;

class CreateController extends Controller
{
    private ChannelCategoryService $categoryService;

    public function __construct(ChannelCategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }

    public function __invoke()
    {
        $categories = $this->categoryService->getAll();

        return view('directory.channels.create', compact('categories'));
    }
}
