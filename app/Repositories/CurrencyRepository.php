<?php

namespace App\Repositories;

use App\DTO\CurrencyDTO;
use App\Models\Currency;
use Illuminate\Support\Carbon;

class CurrencyRepository
{
    public function getAll($perPage)
    {
        return Currency::with('period')
            ->where('deleted', 0)
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    public function store($request)
    {
        $currencyDTO = new CurrencyDTO(
            $request->input('name'),
            $request->input('period_id'),
            $request->input('exchange_start'),
            $request->input('exchange_stop'),
        );

        $currency = new Currency();
        $currency->name = $currencyDTO->name;
        $currency->period_id = $currencyDTO->period_id;
        $currency->exchange_start = $currencyDTO->exchange_start;
        $currency->exchange_stop = $currencyDTO->exchange_stop;

        $currency->dt_start = Carbon::now();
        $currency->dt_stop = Carbon::createFromDate(2500, 1, 1, 0, 0, 0);

        return $currency->save();
    }

    public function update($request, $currency)
    {
        $currencyDTO = new CurrencyDTO(
            $request->input('name'),
            $request->input('period_id'),
            $request->input('exchange_start'),
            $request->input('exchange_stop'),
        );

        $currency->name = $currencyDTO->name;
        $currency->period_id = $currencyDTO->period_id;
        $currency->exchange_start = $currencyDTO->exchange_start;
        $currency->exchange_stop = $currencyDTO->exchange_stop;

        $currency->dt_start = Carbon::now();
        $currency->dt_stop = Carbon::createFromDate(2500, 1, 1, 0, 0, 0);

        return $currency->save();
    }

    public function delete($currency)
    {
        $currency = Currency::findOrFail($currency->id);
        $currency->deleted = 1;

        return $currency->save();
    }
}
