<?php

namespace App\Http\Controllers\Directory\Counterparties;

use App\Http\Controllers\Controller;
use App\Services\CounterpartyService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private CounterpartyService $service;

    public function __construct(CounterpartyService $service) {
        $this->service = $service;
    }

    public function __invoke(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $counterparties = $this->service->getAll($perPage);

        return view('directory.counterparties.index', compact('counterparties'));
    }
}
