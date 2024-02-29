<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currencies';

    protected $fillable = [
        'name',
        'exchange_start',
        'exchange_stop',
        'dt_start',
        'dt_stop',
        'deleted',
        'period_id',
    ];

    public function period()
    {
        return $this->belongsTo(Period::class, 'period_id');
    }
}
