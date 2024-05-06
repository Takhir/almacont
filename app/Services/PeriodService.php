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

    public function store($reportPeriodDTO)
    {
        return $this->repository->store($reportPeriodDTO);
    }

    public function update($reportPeriodDTO, $period)
    {
        return $this->repository->update($reportPeriodDTO, $period);
    }

    public function delete($period)
    {
        return $this->repository->delete($period);
    }
}
