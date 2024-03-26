<?php

namespace App\Http\Controllers\FillingPackages;

use App\Http\Controllers\Controller;
use App\Models\Currency;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('filling-packages.index');
    }
}
