<?php

namespace App\Repositories;

use App\Models\Department;
use App\Models\Package;

class DepartmentRepository
{
    public function all()
    {
        return Department::get();
    }

    public function getAll($perPage)
    {
        return Department::orderBy('id', 'desc')->paginate($perPage);
    }

    public function getTowns()
    {
        return Department::get()->pluck('town', 'town_id');
    }

    public function getIdByDepartment(string $department)
    {
        return Department::getIdByDepartment($department);
    }

    public function getTownIdByTown(string $town)
    {
        return Department::getTownIdByTown($town);
    }

}
