<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'departments2';

    public function town()
    {
        return $this->belongsTo(Town::class, 'id', 'department_id');
    }
}
