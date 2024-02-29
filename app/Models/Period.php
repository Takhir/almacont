<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Period extends Model
{
    use SoftDeletes;

    protected $table = 'periods';

    protected $fillable = [
        'name',
        'dt_start',
        'dt_stop',
    ];

    public static function getNameById($id)
    {
        $model = static::find($id);
        return $model ? $model->name : null;
    }
}
