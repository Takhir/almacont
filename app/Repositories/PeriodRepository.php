<?php

namespace App\Repositories;

use App\Dto\PeriodDTO;
use App\Models\Period;

class PeriodRepository
{
    public function all($perPage)
    {
        return Period::orderBy('id', 'desc')->paginate($perPage);
    }

    public function getAll()
    {
        return Period::orderBy('id', 'desc')->get();
    }

    public function getNameById($id)
    {
        return Period::getNameById($id);
    }

    public function store($request)
    {
        $reportPeriodDTO = new PeriodDTO(
            $request->input('name'),
        );

        $period = new Period();
        $period->name = $reportPeriodDTO->name;

        return $period->save();
    }

    public function update($request, $period)
    {
        $reportPeriodDTO = new PeriodDTO(
            $request->input('name'),
        );

        $period->name = $reportPeriodDTO->name;

        return $period->save();
    }

    public function delete($period)
    {
        return $period->delete();
    }
}
