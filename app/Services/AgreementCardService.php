<?php

namespace App\Services;

use App\Repositories\AgreementCardRepository;

class AgreementCardService
{
    private AgreementCardRepository $repository;

    public function __construct(AgreementCardRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll($request)
    {
        return $this->repository->getAll($request);
    }

    public function store($request)
    {
        return $this->repository->store($request);
    }

    public function update($request, $agreement)
    {
        return $this->repository->update($request, $agreement);
    }

    public function delete($agreement)
    {
        return $this->repository->delete($agreement);
    }
}
