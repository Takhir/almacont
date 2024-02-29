<?php

namespace App\DTO;

class CurrencyDTO
{
    public string $exchange_start, $exchange_stop;
    public int $currency_type_id, $period_id;

    public function __construct(int $currency_type_id, int $period_id, string $exchange_start, string $exchange_stop)
    {
        $this->currency_type_id = $currency_type_id;
        $this->period_id = $period_id;
        $this->exchange_start = $exchange_start;
        $this->exchange_stop = $exchange_stop;
    }
}
