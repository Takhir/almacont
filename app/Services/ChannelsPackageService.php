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

    public function getFilling($channelsPackageFilterDTO)
    {
        return $this->repository->getFilling($channelsPackageFilterDTO);
    }

    public function getAll($channelsPackageFilterDTO)
    {
        return $this->repository->getAll($channelsPackageFilterDTO);
    }

    public function store($channelsPackageDTO)
    {
        return $this->repository->store($channelsPackageDTO);
    }

    public function update($channelsPackageDTO, $channelsPackage)
    {
        return $this->repository->update($channelsPackageDTO, $channelsPackage);
    }

    public function delete($channelsPackage)
    {
        return $this->repository->delete($channelsPackage);
    }

    public function import($file)
    {
        return $this->repository->import($file);
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
