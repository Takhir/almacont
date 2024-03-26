<?php

namespace App\Http\Controllers\Directory\Periods;

use App\Http\Controllers\Controller;
use App\Models\Period;

class EditController extends Controller
{
    public function __invoke(Period $period)
    {
        return view('directory.periods.edit', compact('period'));
    }
}
