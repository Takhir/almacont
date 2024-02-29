<?php

namespace App\Services;

use App\Repositories\CounterpartyRepository;

class CounterpartyService
{
    private CounterpartyRepository $repository;

    public function __construct(CounterpartyRepository $repository)
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

    public function update($request, $counterparty)
    {
        return $this->repository->update($request, $counterparty);
    }

    public function delete($counterparty)
    {
        return $this->repository->delete($counterparty);
    }
}
