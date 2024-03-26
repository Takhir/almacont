<?php

namespace App\Http\Controllers\Directory\Currency;

use App\Http\Controllers\Controller;
use App\Services\CurrencyService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private CurrencyService $service;

    public function __construct(CurrencyService $service) {
        $this->service = $service;
    }
    public function __invoke(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $currencies = $this->service->getAll($perPage);

        return view('directory.currency.index', compact('currencies'));
    }
}
