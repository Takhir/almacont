<?php

namespace App\Http\Controllers\Directory\Packages;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('directory.packages.index');
    }
}
