<?php

namespace App\Repositories;

use App\DTO\ChannelDTO;
use App\Models\Channel;
use Illuminate\Support\Carbon;

class ChannelRepository
{
    public function getAll($perPage)
    {
        return Channel::where('deleted', 0)->orderBy('id', 'desc')->paginate($perPage);
    }

    public function store($request)
    {
        $channelDTO = new ChannelDTO(
            $request->input('name'),
            $request->input('bin'),
            $request->input('resident')
        );

        $channel = new Channel();
        $channel->name = $channelDTO->name;
        $channel->bin = $channelDTO->bin;
        $channel->resident = $channelDTO->resident;

        $channel->dt_start = Carbon::now();
        $channel->dt_stop = Carbon::createFromDate(2500, 1, 1, 0, 0, 0);

        return $channel->save();
    }

    public function update($request, $channel)
    {
        $channelDTO = new ChannelDTO(
            $request->input('name'),
            $request->input('bin'),
            $request->input('resident'),
        );

        $channel->name = $channelDTO->name;
        $channel->bin = $channelDTO->bin;
        $channel->resident = $channelDTO->resident;

        $channel->dt_start = Carbon::now();
        $channel->dt_stop = Carbon::createFromDate(2500, 1, 1, 0, 0, 0);

        return $channel->save();
    }

    public function delete($channel)
    {
        $channel = Channel::findOrFail($channel->id);
        $channel->deleted = 1;

        return $channel->save();
    }
}
