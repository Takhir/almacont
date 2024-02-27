<?php

namespace App\Repositories;

use App\Models\ReportPeriod;

class PeriodRepository
{
    public function getAll()
    {
        return ReportPeriod::orderBy('id', 'desc')->get();
    }

    public function getNameById($id)
    {
        return ReportPeriod::getNameById($id);
    }
}
