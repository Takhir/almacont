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

    public function all()
    {
        return $this->repository->all();
    }

    public function getAll($perPage)
    {
        return $this->repository->getAll($perPage);
    }

    public function store($counterpartyDTO)
    {
        return $this->repository->store($counterpartyDTO);
    }

    public function update($counterpartyDTO, $counterparty)
    {
        return $this->repository->update($counterpartyDTO, $counterparty);
    }

    public function delete($counterparty)
    {
        return $this->repository->delete($counterparty);
    }

    public function import($request)
    {
        return $this->repository->import($request);
    }

    public function export()
    {
        $file = $this->repository->export();

        if ($file) {
            return $file;
        }

        return false;
    }
}
