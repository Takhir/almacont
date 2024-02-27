<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'api_fw_valuta';

    protected $fillable = [
        'v_name',
        'n_exchange_start',
        'n_exchange_stop',
        'dt_start',
        'dt_stop',
        'b_deleted',
        'report_period_id',
    ];

    public function period()
    {
        return $this->belongsTo(ReportPeriod::class, 'report_period_id');
    }
}
