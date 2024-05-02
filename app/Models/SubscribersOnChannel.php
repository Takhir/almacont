<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscribersOnChannel extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel_id',
        'period_id',
        'quantity',
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    public function period()
    {
        return $this->belongsTo(Period::class, 'period_id');
    }
}
