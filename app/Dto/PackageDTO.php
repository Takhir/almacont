<?php

namespace App\Dto;

class PackageDTO
{
    public string $name, $description;
    public int $active;

    public function __construct(string $name, ?string $description, int $active)
    {
        $this->name = $name;
        $this->description = $description;
        $this->active = $active;
    }
}
