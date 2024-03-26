<?php

namespace App\Http\Controllers\Calculations;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('calculations.index');
    }
}
