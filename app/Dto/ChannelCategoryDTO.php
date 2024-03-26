<?php

namespace App\Dto;

class ChannelCategoryDTO
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
