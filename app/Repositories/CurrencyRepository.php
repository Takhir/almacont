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
            ->where('b_deleted', 0)
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    public function store($request)
    {
        $currencyDTO = new CurrencyDTO(
            $request->input('v_name'),
            $request->input('report_period_id'),
            $request->input('n_exchange_start'),
            $request->input('n_exchange_stop'),
        );

        $currency = new Currency();
        $currency->v_name = $currencyDTO->v_name;
        $currency->report_period_id = $currencyDTO->report_period_id;
        $currency->n_exchange_start = $currencyDTO->n_exchange_start;
        $currency->n_exchange_stop = $currencyDTO->n_exchange_stop;

        $currency->dt_start = Carbon::now();
        $currency->dt_stop = Carbon::createFromDate(2500, 1, 1, 0, 0, 0);

        return $currency->save();
    }

    public function update($request, $currency)
    {
        $currencyDTO = new CurrencyDTO(
            $request->input('v_name'),
            $request->input('report_period_id'),
            $request->input('n_exchange_start'),
            $request->input('n_exchange_stop'),
        );

        $currency->v_name = $currencyDTO->v_name;
        $currency->report_period_id = $currencyDTO->report_period_id;
        $currency->n_exchange_start = $currencyDTO->n_exchange_start;
        $currency->n_exchange_stop = $currencyDTO->n_exchange_stop;

        $currency->dt_start = Carbon::now();
        $currency->dt_stop = Carbon::createFromDate(2500, 1, 1, 0, 0, 0);

        return $currency->save();
    }

    public function delete($currency)
    {
        $currency = Currency::findOrFail($currency->id);
        $currency->b_deleted = 1;

        return $currency->save();
    }
}
