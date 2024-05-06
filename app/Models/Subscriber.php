<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscriber extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'id',
        'period_id',
        'town_id',
        'package_name',
        'package_id',
        'quantity',
    ];

    public function town()
    {
        return $this->belongsTo(Town::class, 'town_id');
    }

    public function period()
    {
        return $this->belongsTo(Period::class, 'period_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
