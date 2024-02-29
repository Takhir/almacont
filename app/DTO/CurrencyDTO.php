<?php

namespace App\DTO;

class CurrencyDTO
{
    public string $name, $exchange_start, $exchange_stop;
    public int $period_id;

    public function __construct(string $name, int $period_id, string $exchange_start, string $exchange_stop)
    {
        $this->name = $name;
        $this->period_id = $period_id;
        $this->exchange_start = $exchange_start;
        $this->exchange_stop = $exchange_stop;
    }
}
