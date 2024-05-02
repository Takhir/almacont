<?php

namespace App\Repositories;

use App\Dto\PeriodDTO;
use App\Models\ChannelsPackage;
use App\Models\Period;
use App\Models\Subscriber;
use App\Models\SubscribersOnChannel;
use Carbon\Carbon;

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
}
