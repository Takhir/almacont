<?php

namespace App\Services;

use App\Repositories\PeriodRepository;

class PeriodService
{
    private PeriodRepository $repository;

    public function __construct(PeriodRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all($perPage)
    {
        return $this->repository->all($perPage);
    }
    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getNameById($id)
    {
        return $this->repository->getNameById($id);
    }

    public function getIdByName(string $name)
    {
        return $this->repository->getIdByName($name);
    }

    public function store($request)
    {
        return $this->repository->store($request);
    }

    public function update($request, $period)
    {
        return $this->repository->update($request, $period);
    }

    public function delete($period)
    {
        return $this->repository->delete($period);
    }
}
