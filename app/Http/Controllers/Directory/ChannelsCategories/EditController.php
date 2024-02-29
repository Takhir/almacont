<?php

namespace App\Http\Controllers\Directory\ChannelsCategories;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\ChannelCategory;

class EditController extends Controller
{
    public function __invoke(ChannelCategory $category)
    {

        return view('directory.channels-categories.edit', compact('category'));
    }
}
