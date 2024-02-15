<?php

namespace App\Http\Controllers\Directory\Currency;

use App\Http\Controllers\Controller;
use App\Models\Currency;

class IndexController extends Controller
{
    public function __invoke()
    {
        //$currencies = Currency::all();

        return view('directory.currency.index');//, compact('currencies'));
    }
}
