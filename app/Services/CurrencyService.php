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

}
