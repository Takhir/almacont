<?php

namespace App\Repositories;

use App\Models\Subscriber;

class SubscriberRepository
{
    public function getAll($request)
    {
        $perPage = $request->input('per_page', 20);
        $periodId = $request->input('period_id');
        $townId = $request->input('town_id');
        $package = $request->input('service_name');
        $query = Subscriber::with('department')
            ->with('period')
            ->orderBy('id', 'desc');

        if ($periodId) {
            $query->where('period_id', $periodId);
        }

        if ($townId) {
            $query->where('town_id', $townId);
        }

        if ($package) {
            $query->where('service_name', 'like', $package);
        }

        return $query->paginate($perPage);
    }

    public function getServices()
    {
        return Subscriber::get()->pluck('service_name', 'service_name');
    }

    public function delete($subscriber)
    {
        return $subscriber->delete();
    }

}
