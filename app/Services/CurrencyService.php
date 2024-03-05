<?php

namespace App\Services;

use App\Repositories\CurrencyRepository;

class CurrencyService
{
    private CurrencyRepository $repository;

    public function __construct(CurrencyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll($perPage)
    {
        return $this->repository->getAll($perPage);
    }

    public function store($request)
    {
        return $this->repository->store($request);
    }

    public function update($request, $currency)
    {
        return $this->repository->update($request, $currency);
    }

    public function delete($currency)
    {
        return $this->repository->delete($currency);
    }

    public function currenciesById($periodId, $request)
    {
        $currencies = $this->repository->currenciesById($periodId);
        $currencyId = $request->get('currency_id') ?? null;
        $result = '';

        foreach ($currencies as $currency)
        {
            if(is_null($currencyId)) {
                $result .= '<option value=' . $currency->id . '>' . $currency->type->name . '</option>';
            } else {
                $result .= '<option value="' . $currency->id . '"';
                $result .= $currencyId == $currency->id ? ' selected' : '';
                $result .= '>' . $currency->type->name . '</option>';
            }
        }

        return $result;
    }

}
