<?php

namespace App\Http\Controllers\AgreementCard;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('agreement-card.index');
    }
}
