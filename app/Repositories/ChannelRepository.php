<?php

namespace App\Repositories;

use App\Dto\ChannelDTO;
use App\Models\Channel;
use Illuminate\Support\Carbon;

class ChannelRepository
{
    public function all()
    {
        return Channel::orderBy('id', 'desc')->get();
    }

    public function getAll($perPage)
    {
        return Channel::orderBy('id', 'desc')->paginate($perPage);
    }

    public function store($request)
    {
        $channelDTO = new ChannelDTO(
            $request->input('name'),
            $request->input('description'),
            $request->input('category_id')
        );

        $channel = new Channel();
        $channel->name = $channelDTO->name;
        $channel->description = $channelDTO->description;
        $channel->category_id = $channelDTO->category_id;

        return $channel->save();
    }

    public function update($request, $channel)
    {
        $channelDTO = new ChannelDTO(
            $request->input('name'),
            $request->input('description'),
            $request->input('category_id'),
        );

        $channel->name = $channelDTO->name;
        $channel->description = $channelDTO->description;
        $channel->category_id = $channelDTO->category_id;

        return $channel->save();
    }

    public function delete($channel)
    {
        return $channel->delete();
    }
}
