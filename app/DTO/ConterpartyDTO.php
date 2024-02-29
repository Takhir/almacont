<?php

namespace App\DTO;

class ConterpartyDTO
{
    public string $name, $bin;
    public int $resident;

    public function __construct(string $name, string $bin, int $resident)
    {
        $this->name = $name;
        $this->bin = $bin;
        $this->resident = $resident;
    }
}
