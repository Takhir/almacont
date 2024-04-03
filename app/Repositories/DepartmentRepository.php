<?php

namespace App\Repositories;

use App\Models\Department;

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

    public function getDepartmentIdById(int $id)
    {
        return Department::getDepartmentIdById($id);
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
