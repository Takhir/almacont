<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Period extends Model
{
    use SoftDeletes, HasFactory;

    public static function getNameById($id)
    {
        $model = static::find($id);
        return $model ? $model->name : null;
    }

    public static function getIdByName($name)
    {
        $model = static::whereRaw('UPPER(name) = ?', [strtoupper($name)])->first();
        //dd($model->id);
        return $model ? $model->id : null;
    }

}
