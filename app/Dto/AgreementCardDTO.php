<?php

namespace App\Dto;

class AgreementCardDTO
{
    public int $channel_id, $counterparty_id, $currency_id, $period_id, $currency_presence;
    public string $sum;

    public function __construct(int $channel_id, int $counterparty_id, string $sum, int $currency_id, int $period_id, int $currency_presence)
    {
        $this->channel_id = $channel_id;
        $this->counterparty_id = $counterparty_id;
        $this->sum = $sum;
        $this->currency_id = $currency_id;
        $this->period_id = $period_id;
        $this->currency_presence = $currency_presence;
    }
}
