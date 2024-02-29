<?php

namespace App\DTO;

class ChannelCategoryDTO
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
