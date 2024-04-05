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
        $package = $request->input('package_name');
        $query = Subscriber::with('department')
            ->with('period')
            ->with('package')
            ->orderBy('id', 'desc');

        if ($periodId) {
            $query->where('period_id', $periodId);
        }

        if ($townId) {
            $query->where('town_id', $townId);
        }

        if ($package) {
            $query->where('package_name', 'like', $package);
        }

        return $query->paginate($perPage);
    }

    public function getServices()
    {
        return Subscriber::get()->pluck('package_name', 'package_name');
    }

    public function delete($subscriber)
    {
        return $subscriber->delete();
    }

    public function import($request)
    {
        return Excel::import(new SubscribersImport, $request->file('subscribers_import'));
    }

}
