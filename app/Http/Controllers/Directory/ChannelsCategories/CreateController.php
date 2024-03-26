<?php

namespace App\Http\Controllers\Directory\ChannelsCategories;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke()
    {
        return view('directory.channels-categories.create');
    }
}
