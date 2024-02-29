<?php

namespace App\Services;

use App\Repositories\PackageRepository;

class PackageService
{
    private PackageRepository $repository;

    public function __construct(PackageRepository $repository)
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

    public function update($request, $counterpart)
    {
        return $this->repository->update($request, $counterpart);
    }

    public function delete($counterpart)
    {
        return $this->repository->delete($counterpart);
    }
}
