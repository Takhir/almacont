<?php

namespace App\Dto;

class SubscribeDTO
{
    public int $per_page;
    public ?int $period_id, $town_id, $package_id;

    public function __construct(int $per_page,  ?int $period_id, ?int $town_id, ?int $package_id)
    {
        $this->per_page = $per_page;
        $this->period_id = $period_id;
        $this->town_id = $town_id;
        $this->package_id = $package_id;
    }
}
