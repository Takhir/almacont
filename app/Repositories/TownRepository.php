<?php

namespace App\Repositories;

use App\Models\Town;

class TownRepository
{
    public function all()
    {
        return Town::orderBy('name')->get();
    }

    public function getTowns($departmentId)
    {
        $departmentIds = explode(',', $departmentId);

        return Town::orderBy('name')->whereIn('department_id', $departmentIds)->get();
    }

    public function getId(string $name)
    {
        return Town::where('name', $name)->first()->id;
    }

    public function existTown($departmentId, $townId)
    {
        return Town::where('department_id', $departmentId)->where('id', $townId)->first();
    }

}
