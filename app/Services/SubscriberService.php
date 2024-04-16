<?php

namespace App\Services;

use App\Repositories\SubscriberRepository;

class SubscriberService
{
    private SubscriberRepository $repository;

    public function __construct(SubscriberRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll($request)
    {
        return $this->repository->getAll($request);
    }

    public function delete($subscriber)
    {
        return $this->repository->delete($subscriber);
    }

    public function import($request)
    {
        return $this->repository->import($request);
    }
}
