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

    public function update($request, $channel)
    {
        return $this->repository->update($request, $channel);
    }

    public function delete($channel)
    {
        return $this->repository->delete($channel);
    }

    public function getIdByName(string $name)
    {
        return $this->repository->getIdByName($name);
    }

    public function import($request)
    {
        return $this->repository->import($request);
    }
}
