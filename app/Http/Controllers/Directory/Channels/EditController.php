<?php

namespace App\Http\Controllers\Directory\Channels;

use App\Http\Controllers\Controller;
use App\Models\Channel;

class EditController extends Controller
{
    public function __invoke(Channel $channel)
    {

        return view('directory.channels.edit', compact('channel'));
    }
}
