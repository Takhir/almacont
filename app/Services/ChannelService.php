<?php

namespace App\Services;

use App\Repositories\ChannelRepository;

class ChannelService
{
    private ChannelRepository $repository;

    public function __construct(ChannelRepository $repository)
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
