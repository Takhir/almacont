<?php

namespace App\Services;

use App\Repositories\TownRepository;

class TownService
{
    private TownRepository $repository;

    public function __construct(TownRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function getTowns($departmentId)
    {
        return $this->repository->getTowns($departmentId);
    }

    public function getId(string $name)
    {
        return $this->repository->getId($name);
    }
}
