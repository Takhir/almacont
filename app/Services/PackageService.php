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

    public function all()
    {
        return $this->repository->all();
    }

    public function getAll($perPage)
    {
        return $this->repository->getAll($perPage);
    }

    public function store($packageDTO)
    {
        return $this->repository->store($packageDTO);
    }

    public function update($packageDTO, $package)
    {
        return $this->repository->update($packageDTO, $package);
    }

    public function delete($package)
    {
        return $this->repository->delete($package);
    }

    public function getIdByName(string $name)
    {
        return $this->repository->getIdByName($name);
    }

    public function import($file)
    {
        return $this->repository->import($file);
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
