<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'dt_start',
        'dt_stop',
        'deleted',
        'theme',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(ChannelCategory::class, 'category_id');
    }
}
