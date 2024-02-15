<?php

namespace App\Http\Controllers\Directory\Branches;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('directory.branches.index');
    }
}
