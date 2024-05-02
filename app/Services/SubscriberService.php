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

    public function getAll($subscribeDTO)
    {
        return $this->repository->getAll($subscribeDTO);
    }

    public function delete($subscriber)
    {
        return $this->repository->delete($subscriber);
    }

    public function import($file)
    {
        return $this->repository->import($file);
    }

}
