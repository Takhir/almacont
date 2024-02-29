<?php

namespace App\Repositories;

use App\DTO\ChannelCategoryDTO;
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
        return ChannelCategory::orderBy('id', 'desc')->get();
    }

//    public function getNameById($id)
//    {
//        return ChannelCategory::getNameById($id);
//    }

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
