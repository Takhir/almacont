<?php

namespace App\Http\Controllers\Directory\Counterparties;

use App\Enums\Resident;
use App\Http\Controllers\Controller;
use App\Models\Counterparty;

class EditController extends Controller
{
    public function __invoke(Counterparty $counterparty)
    {
        $resident = Resident::cases();

        return view('directory.counterparties.edit', compact('counterparty', 'resident'));
    }
}
