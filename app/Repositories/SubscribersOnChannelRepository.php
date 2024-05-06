<?php

namespace App\Repositories;

use App\Dto\PeriodDTO;
use App\Exports\SubscribersOnChannelExport;
use App\Models\ChannelsPackage;
use App\Models\Period;
use App\Models\Subscriber;
use App\Models\SubscribersOnChannel;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class SubscribersOnChannelRepository
{
    public function deleteByPeriod(int $periodId)
    {
        return SubscribersOnChannel::where('period_id', $periodId)->delete();
    }

    public function add($channels, $subscribers, $periodId)
    {
        foreach($channels as $channel) {
            if(isset($subscribers[$channel->package_id])) {
                SubscribersOnChannel::updateOrCreate(
                    ['channel_id' => $channel->channel_id, 'period_id' => $periodId],
                    ['quantity' => SubscribersOnChannel::raw('quantity + ' . $subscribers[$channel->package_id])]
                );
            }
        }
    }

    public function subscribersExport(int $periodId)
    {
        $export = new SubscribersOnChannelExport($periodId);
        $fileName = 'subscribers-on-channel.xlsx';
        $filePath = 'public/' . $fileName;

        Excel::store($export, $filePath);

        return $fileName;
    }

    public function allByPeriod(int $periodId)
    {
        return SubscribersOnChannel::join('channels', 'channels.id', '=', 'subscribers_on_channels.channel_id')
            ->join('periods', 'periods.id', '=', 'subscribers_on_channels.period_id')
            ->where('period_id', $periodId)
            ->orderBy('channels.name')
            ->get();
    }
}
