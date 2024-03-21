<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChannelsPackage extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'channel_id',
        'package_id',
        'department_id',
        'town_id',
        'dt_start',
        'dt_stop',
        'presence',
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'department_id');
    }

    public function town()
    {
        return $this->belongsTo(Department::class, 'town_id', 'town_id');
    }
}
