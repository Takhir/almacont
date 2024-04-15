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

    public function getAll($request)
    {
        return $this->repository->getAll($request);
    }

    public function getId(string $name)
    {
        return $this->repository->getId($name);
    }

}
