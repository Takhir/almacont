<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Counterparty extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'bin',
        'resident',
    ];

    public static function getIdByName($name)
    {
        $model = static::where('name', $name)->first();
        return $model ? $model->id : null;
    }
}
