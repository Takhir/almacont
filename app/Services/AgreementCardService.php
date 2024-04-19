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

    public function getAll($perPage, $periodId)
    {
        return $this->repository->getAll($perPage, $periodId);
    }

    public function store($agreementCardDto)
    {
        return $this->repository->store($agreementCardDto);
    }

    public function update($agreementCardDto, $agreement)
    {
        return $this->repository->update($agreementCardDto, $agreement);
    }

    public function delete($agreement)
    {
        return $this->repository->delete($agreement);
    }
}
