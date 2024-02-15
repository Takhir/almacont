<?php

namespace App\Http\Controllers\Directory\Periods;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('directory.periods.index');
    }
}
