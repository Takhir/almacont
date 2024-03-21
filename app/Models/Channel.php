<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Channel extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'description',
        'theme',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(ChannelCategory::class, 'category_id');
    }

    public static function getIdByName($name)
    {
        $model = static::where('name', $name)->first();
        return $model ? $model->id : null;
    }
}
