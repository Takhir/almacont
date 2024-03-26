<?php

namespace App\Http\Controllers\Directory\Currency;

use App\Http\Controllers\Controller;
use App\Http\Requests\Currency\StoreRequest;
use App\Services\CurrencyService;

class StoreController extends Controller
{
    private CurrencyService $service;

    public function __construct(CurrencyService $service) {
        $this->service = $service;
    }

    public function __invoke(StoreRequest $request)
    {
        if ($this->service->store($request))
        {
            return redirect()->route('currency.index')->with('success', 'Данные успешно сохранены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при сохранении');
    }
}
