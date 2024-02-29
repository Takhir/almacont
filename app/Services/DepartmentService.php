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

    public function getAll($perPage)
    {
        return $this->repository->getAll($perPage);
    }
}
