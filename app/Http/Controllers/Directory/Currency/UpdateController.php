<?php

namespace App\Http\Controllers\Directory\Currency;

use App\Dto\CurrencyDTO;
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
        $validated = $request->validated();

        $currencyDTO = new CurrencyDTO(
            $validated['currency_type_id'],
            $validated['period_id'],
            $validated['exchange_start'],
            $validated['exchange_stop'],
        );

        if ($this->service->update($currencyDTO, $currency))
        {
            return redirect()->route('currency.index')->with('success', 'Данные успешно обновлены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при обновлении');
    }
}
