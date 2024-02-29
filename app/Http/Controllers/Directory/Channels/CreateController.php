<?php

namespace App\Http\Controllers\Directory\Channels;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke()
    {
        return view('directory.channels.create');
    }
}
