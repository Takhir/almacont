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

    public function store($currencyDTO)
    {
        return $this->repository->store($currencyDTO);
    }

    public function update($currencyDTO, $currency)
    {
        return $this->repository->update($currencyDTO, $currency);
    }

    public function delete($currency)
    {
        return $this->repository->delete($currency);
    }

    public function currenciesById($periodId, $currencyId)
    {
        $currencies = $this->repository->currenciesById($periodId);
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

    public function getId(int $currencyTypeId, int $periodId)
    {
        return $this->repository->getId($currencyTypeId, $periodId);
    }

}
