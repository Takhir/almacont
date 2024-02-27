<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportPeriod extends Model
{
    protected $table = 'api_fw_report_period';

    protected $fillable = [
        'v_name',
        'dt_start',
        'dt_stop',
    ];

    public static function getNameById($id)
    {
        $model = static::find($id);
        return $model ? $model->v_name : null;
    }
}
