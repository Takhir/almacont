<?php

namespace App\Http\Controllers\Directory\Counterparties;

use App\Enums\Resident;
use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke()
    {
        $resident = Resident::cases();

        return view('directory.counterparties.create', compact('resident'));
    }
}
