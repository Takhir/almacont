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

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getNameById($id)
    {
        return $this->repository->getNameById($id);
    }

}
