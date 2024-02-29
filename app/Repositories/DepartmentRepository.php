<?php

namespace App\Repositories;

use App\Models\Department;

class DepartmentRepository
{
    public function getAll($perPage)
    {
        return Department::orderBy('id', 'desc')->paginate($perPage);
    }
}
