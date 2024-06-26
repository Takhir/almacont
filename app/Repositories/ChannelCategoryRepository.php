<?php

namespace App\Repositories;

use App\Dto\ChannelCategoryDTO;
use App\Models\ChannelCategory;
use Illuminate\Validation\ValidationException;

class ChannelCategoryRepository
{
    public function all($perPage)
    {
        return ChannelCategory::orderBy('name')->paginate($perPage);
    }

    public function getAll()
    {
        return ChannelCategory::all();
    }

    public function getIdByName(string $name)
    {
        return ChannelCategory::getIdByName($name);
    }

    public function store(ChannelCategoryDTO $channelCategoryDTO)
    {
        $category = new ChannelCategory();
        $category->name = $channelCategoryDTO->name;

        return $category->save();
    }

    public function update(ChannelCategoryDTO $channelCategoryDTO, $category)
    {
        $category->name = $channelCategoryDTO->name;

        return $category->save();
    }

    public function delete($category)
    {
        if ($category->channels()->exists()) {
            throw ValidationException::withMessages(['error' => 'Нельзя удалить категорию, к которой привязаны каналы']);
        }

        return $category->delete();
    }
}
