<?php

namespace App\DTO;

class ChannelDTO
{
    public string $name, $description;
    public int $category_id;

    public function __construct(string $name, string $description, int $category_id)
    {
        $this->name = $name;
        $this->description = $description;
        $this->category_id = $category_id;
    }
}
