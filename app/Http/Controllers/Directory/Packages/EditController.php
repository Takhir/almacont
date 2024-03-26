<?php

namespace App\Http\Controllers\Directory\Packages;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Models\Package;

class EditController extends Controller
{
    public function __invoke(Package $package)
    {
        $status = Status::cases();

        return view('directory.packages.edit', compact('package', 'status'));
    }
}
