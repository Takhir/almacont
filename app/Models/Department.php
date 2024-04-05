<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes, HasFactory;

    public static function getDepartmentIdById($id)
    {
        $model = static::find($id);
        return $model ? $model->department_id : null;
    }

    public static function getIdByDepartment($department)
    {
        $model = static::where('department', $department)->first();
        return $model ? $model->department_id : null;
    }

    public static function getTownIdByTown($town)
    {
        $model = static::where('town', $town)->first();
        return $model ? $model->town_id : null;
    }
}
