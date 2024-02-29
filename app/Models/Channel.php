<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Channel extends Model
{
    use SoftDeletes, HasFactory;

    public function category()
    {
        return $this->belongsTo(ChannelCategory::class, 'category_id');
    }
}
