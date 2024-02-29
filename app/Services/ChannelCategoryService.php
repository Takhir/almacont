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

//    public function getNameById($id)
//    {
//        return $this->repository->getNameById($id);
//    }

    public function store($request)
    {
        return $this->repository->store($request);
    }

    public function update($request, $category)
    {
        return $this->repository->update($request, $category);
    }

    public function delete($category)
    {
        return $this->repository->delete($category);
    }
}
