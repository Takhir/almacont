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
    public function getAll($perPage, $channelId)
    {
        return $this->repository->getAll($perPage, $channelId);
    }

    public function store($channelDTO)
    {
        return $this->repository->store($channelDTO);
    }

    public function update($channelDTO, $channel)
    {
        return $this->repository->update($channelDTO, $channel);
    }

    public function delete($channel)
    {
        return $this->repository->delete($channel);
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
