<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscriber extends Model
{
    use SoftDeletes, HasFactory;

    public function department()
    {
        return $this->belongsTo(Department::class, 'town_id', 'town_id');
    }

    public function period()
    {
        return $this->belongsTo(Period::class, 'period_id');
    }
}
