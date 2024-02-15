<?php

namespace App\Http\Controllers\Directory\Channels;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('directory.channels.index');
    }
}
