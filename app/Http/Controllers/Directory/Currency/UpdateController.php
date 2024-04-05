<?php

namespace App\Http\Controllers\Directory\Currency;

use App\Http\Controllers\Controller;
use App\Http\Requests\Currency\UpdateRequest;
use App\Models\Currency;
use App\Services\CurrencyService;

class UpdateController extends Controller
{
    private CurrencyService $service;

    public function __construct(CurrencyService $service) {
        $this->service = $service;
    }

    public function __invoke(UpdateRequest $request, Currency $currency)
    {
        if ($this->service->update($request, $currency))
        {
            return redirect()->route('currency.index')->with('success', 'Данные успешно обновлены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при обновлении');
    }
}
