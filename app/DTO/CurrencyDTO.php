<?php

namespace App\DTO;

class CurrencyDTO
{
    public string $v_name;
    public int $report_period_id;
    public string $n_exchange_start;
    public string $n_exchange_stop;

    public function __construct($v_name, $report_period_id, $n_exchange_start, $n_exchange_stop)
    {
        $this->v_name = $v_name;
        $this->report_period_id = $report_period_id;
        $this->n_exchange_start = $n_exchange_start;
        $this->n_exchange_stop = $n_exchange_stop;
    }
}
