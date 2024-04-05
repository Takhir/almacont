<?php

namespace App\Services;

use App\Repositories\CurrencyTypeRepository;

class CurrencyTypeService
{
    private CurrencyTypeRepository $repository;

    public function __construct(CurrencyTypeRepository $repository)
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
