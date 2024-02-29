<?php

namespace App\Http\Controllers\AgreementsCards;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('agreements-cards.index');
    }
}
