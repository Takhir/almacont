<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Town extends Model
{
    use SoftDeletes, HasFactory;

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
