<?php

namespace App\Dto;

class PeriodDTO
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
