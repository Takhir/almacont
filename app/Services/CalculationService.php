<?php

namespace App\Services;

use App\Repositories\CalculationRepository;

class CalculationService
{
    private CalculationRepository $repository;

    public function __construct(CalculationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $periodId)
    {
        return $this->repository->execute($periodId);
    }

}
