<?php

namespace App\Services;

use App\Repositories\ChannelsPackageRepository;

class ChannelsPackageService
{
    private ChannelsPackageRepository $repository;

    public function __construct(ChannelsPackageRepository $repository)
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

    public function update($request, $channelsPackage)
    {
        return $this->repository->update($request, $channelsPackage);
    }

    public function delete($channelsPackage)
    {
        return $this->repository->delete($channelsPackage);
    }

    public function import($request)
    {
        return $this->repository->import($request);
    }

    public function export($request)
    {
        $file = $this->repository->export($request);

        if ($file) {
            return $file;
        }

        return false;
    }
}
