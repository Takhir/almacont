<?php

namespace App\Repositories;

use App\Dto\ChannelDTO;
use App\Models\Channel;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ChannelsImport;
use App\Exports\ChannelsExport;

class ChannelRepository
{
    public function all()
    {
        return Channel::orderBy('name')->get();
    }

    public function getAll($perPage, $channelId)
    {
        $query = Channel::orderBy('name');

        if ($channelId) {
            $query->where('id', $channelId);
        }

        return $query->paginate($perPage);
    }

    public function store(ChannelDTO $channelDTO)
    {
        $channel = new Channel();
        $channel->name = $channelDTO->name;
        $channel->description = $channelDTO->description;
        $channel->category_id = $channelDTO->category_id;

        return $channel->save();
    }

    public function update(ChannelDTO $channelDTO, Channel $channel)
    {
        $channel->name = $channelDTO->name;
        $channel->description = $channelDTO->description;
        $channel->category_id = $channelDTO->category_id;

        return $channel->save();
    }

    public function delete(Channel $channel)
    {
        return $channel->delete();
    }

    public function getIdByName(string $name)
    {
        return Channel::getIdByName($name);
    }

    public function import($file)
    {
        return Excel::import(new ChannelsImport, $file);
    }

    public function export()
    {
        $export = new ChannelsExport;
        $fileName = 'channels.xlsx';
        $filePath = 'public/' . $fileName;

        Excel::store($export, $filePath);

        return $fileName;
    }
}
