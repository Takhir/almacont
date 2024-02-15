<?php

namespace App\Http\Controllers\Directory\Counterparties;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('directory.counterparties.index');
    }
}
