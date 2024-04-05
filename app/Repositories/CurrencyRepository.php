<?php

namespace App\Repositories;

use App\Dto\CurrencyDTO;
use App\Models\Currency;

class CurrencyRepository
{
    public function getAll($perPage)
    {
        return Currency::with('type')
            ->with('period')
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    public function store($request)
    {
        $currencyDTO = new CurrencyDTO(
            $request->input('currency_type_id'),
            $request->input('period_id'),
            $request->input('exchange_start'),
            $request->input('exchange_stop'),
        );

        $currency = new Currency();
        $currency->currency_type_id = $currencyDTO->currency_type_id;
        $currency->period_id = $currencyDTO->period_id;
        $currency->exchange_start = (float)str_replace(',', '.', $currencyDTO->exchange_start);
        $currency->exchange_stop = (float)str_replace(',', '.', $currencyDTO->exchange_stop);

        return $currency->save();
    }

    public function update($request, $currency)
    {
        $currencyDTO = new CurrencyDTO(
            $request->input('currency_type_id'),
            $request->input('period_id'),
            $request->input('exchange_start'),
            $request->input('exchange_stop'),
        );

        $currency->currency_type_id = $currencyDTO->currency_type_id;
        $currency->period_id = $currencyDTO->period_id;
        $currency->exchange_start = (float)str_replace(',', '.', $currencyDTO->exchange_start);
        $currency->exchange_stop = (float)str_replace(',', '.', $currencyDTO->exchange_stop);

        return $currency->save();
    }

    public function delete($currency)
    {
        return $currency->delete();
    }

    public function currenciesById($periodId)
    {
        return Currency::where('period_id', $periodId)->get();
    }
}
