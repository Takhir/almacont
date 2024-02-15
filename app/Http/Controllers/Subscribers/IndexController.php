<?php

namespace App\Http\Controllers\Subscribers;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('subscribers.index');
    }
}
