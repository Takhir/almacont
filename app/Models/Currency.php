<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'API_FW_VALUTA';

    protected $fillable = [
        'V_NAME',
        'N_EXCHANGE_START',
        'N_EXCHANGE_STOP',
        'B_DELETED',
        'ID_REPORTPERIOD_ID',
    ];
}
