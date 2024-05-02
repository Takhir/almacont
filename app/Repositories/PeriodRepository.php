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

    public function getIdByName(string $name)
    {
        return Period::getIdByName($name);
    }

    public function store(PeriodDTO $reportPeriodDTO)
    {
        $period = new Period();
        $period->name = $reportPeriodDTO->name;

        return $period->save();
    }

    public function update(PeriodDTO $reportPeriodDTO, Period $period)
    {
        $period->name = $reportPeriodDTO->name;

        return $period->save();
    }

    public function delete(Period $period)
    {
        return $period->delete();
    }

    public function findById(int $id)
    {
        return Period::find($id);
    }
}
