<?php

namespace App\Repositories;

use App\Dto\ChannelCategoryDTO;
use App\Models\ChannelCategory;
use Illuminate\Support\Carbon;

class ChannelCategoryRepository
{
    public function all($perPage)
    {
        return ChannelCategory::orderBy('id', 'desc')->paginate($perPage);
    }

    public function getAll()
    {
        return ChannelCategory::all();
    }

    public function store($request)
    {
        $channelCategoryDTO = new ChannelCategoryDTO(
            $request->input('name'),
        );

        $category = new ChannelCategory();
        $category->name = $channelCategoryDTO->name;

        return $category->save();
    }

    public function update($request, $category)
    {
        $channelCategoryDTO = new ChannelCategoryDTO(
            $request->input('name'),
        );

        $category->name = $channelCategoryDTO->name;

        return $category->save();
    }

    public function delete($category)
    {
        return $category->delete();
    }
}
