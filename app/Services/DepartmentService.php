<?php

namespace App\Services;

use App\Repositories\DepartmentRepository;

class DepartmentService
{
    private DepartmentRepository $repository;

    public function __construct(DepartmentRepository $repository)
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

    public function getId(string $name)
    {
        return $this->repository->getId($name);
    }

}
