<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CurrencyType extends Model
{
    use HasFactory;

    public static function getNameById(int $id)
    {
        $model = static::find($id);
        return $model ? $model->name : null;
    }

    public static function getIdByName(string $name)
    {
        $model = static::where('name', $name)->first();
        return $model ? $model->id : null;
    }
}
