<?php

namespace App\Repositories;

use App\Imports\SubscribersImport;
use App\Models\Subscriber;
use Maatwebsite\Excel\Facades\Excel;

class SubscriberRepository
{
    public function getAll($subscribeDTO)
    {
        $query = Subscriber::join('towns', 'towns.id', '=', 'subscribers.town_id')
            ->join('periods', 'periods.id', '=', 'subscribers.period_id')
            ->join('packages', 'packages.id', '=', 'subscribers.package_id')
            ->orderBy('periods.id')
            ->orderBy('towns.name')
            ->orderBy('packages.name');

        if ($subscribeDTO->period_id) {
            $query->where('period_id', $subscribeDTO->period_id);
        }

        if ($subscribeDTO->town_id) {
            $query->where('subscribers.town_id', $subscribeDTO->town_id);
        }

        if ($subscribeDTO->package_id) {
            $query->where('package_id', $subscribeDTO->package_id);
        }

        return $query->paginate($subscribeDTO->per_page);
    }

    public function delete(Subscriber $subscriber)
    {
        return $subscriber->delete();
    }

    public function import($file)
    {
        return Excel::import(new SubscribersImport, $file);
    }

    public function subscribersByPeriod($channels, int $periodId)
    {
        $packages = [];

        foreach($channels as $channel) {
            $packages[] = $channel->package_id;
        }

        $packages = array_unique($packages);

        return Subscriber::select('period_id', 'package_id', Subscriber::raw('SUM(quantity) as total_quantity'))
            ->where('period_id', $periodId)
            ->whereIn('package_id', $packages)
            ->groupBy('period_id', 'package_id')
            ->pluck('total_quantity', 'package_id')->toArray();
    }

}
