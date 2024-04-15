<?php

namespace App\Repositories;

use App\Imports\SubscribersImport;
use App\Models\Subscriber;
use Maatwebsite\Excel\Facades\Excel;

class SubscriberRepository
{
    public function getAll($request)
    {
        $perPage = $request->input('per_page', 20);
        $periodId = $request->input('period_id');
        $townId = $request->input('town_id');
        $packageId = $request->input('package_id');
        $query = Subscriber::join('departments', 'departments.town_id', '=', 'subscribers.town_id')
            ->join('periods', 'periods.id', '=', 'subscribers.period_id')
            ->join('packages', 'packages.id', '=', 'subscribers.package_id')
            ->orderBy('periods.id')
            ->orderBy('departments.town')
            ->orderBy('packages.name');

        if ($periodId) {
            $query->where('period_id', $periodId);
        }

        if ($townId) {
            $query->where('subscribers.town_id', $townId);
        }

        if ($packageId) {
            $query->where('package_id', $packageId);
        }

        return $query->paginate($perPage);
    }

//    public function getServices()
//    {
//        return Subscriber::get()->pluck('package_name', 'package_name');
//    }

    public function delete($subscriber)
    {
        return $subscriber->delete();
    }

    public function import($request)
    {
        return Excel::import(new SubscribersImport, $request->file('subscribers_import'));
    }

}
