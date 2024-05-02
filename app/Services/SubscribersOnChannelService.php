<?php

namespace App\Services;

use App\Repositories\SubscribersOnChannelRepository;

class SubscribersOnChannelService
{
    private SubscribersOnChannelRepository $repository;

    public function __construct(SubscribersOnChannelRepository $repository)
    {
        $this->repository = $repository;
    }

    public function delete(int $periodId)
    {
        return $this->repository->delete($periodId);
    }
}
