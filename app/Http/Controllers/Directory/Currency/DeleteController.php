<?php

namespace App\Http\Controllers\Directory\Currency;

use App\Http\Controllers\Controller;
use App\Http\Requests\Currency\UpdateRequest;
use App\Models\Currency;
use App\Services\CurrencyService;

class DeleteController extends Controller
{
    private CurrencyService $service;

    public function __construct(CurrencyService $service) {
        $this->service = $service;
    }

    public function __invoke(Currency $currency)
    {
        if ($this->service->delete($currency))
        {
            return redirect()->route('currency.index')->with('success', 'Данные успешно удалены');
        }

        return redirect()->back()->with('error', 'Произошла ошибка при удалении');
    }
}
