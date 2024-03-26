<?php

namespace App\Http\Controllers\Directory\Packages;

use App\Enums\Status;
use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke()
    {
        $status = Status::cases();

        return view('directory.packages.create', compact('status'));
    }
}
