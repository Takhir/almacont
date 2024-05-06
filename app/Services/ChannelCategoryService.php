<?php

namespace App\Services;

use App\Repositories\ChannelCategoryRepository;

class ChannelCategoryService
{
    private ChannelCategoryRepository $repository;

    public function __construct(ChannelCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all($perPage)
    {
        return $this->repository->all($perPage);
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getIdByName(string $name)
    {
        return $this->repository->getIdByName($name);
    }

    public function store($channelCategoryDTO)
    {
        return $this->repository->store($channelCategoryDTO);
    }

    public function update($channelCategoryDTO, $category)
    {
        return $this->repository->update($channelCategoryDTO, $category);
    }

    public function delete($category)
    {
        return $this->repository->delete($category);
    }
}
