<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelCategory extends Model
{
    use HasFactory;

    public static function getIdByName($name)
    {
        $model = static::where('name', $name)->first();
        return $model ? $model->id : null;
    }
}
