<?php

namespace App\Dto;

class ChannelsPackageFilterDTO
{
    public int $per_page;
    public ?array $channel_id, $category_id, $package_id, $department_id, $town_id;
    public ?string $dt_start_from, $dt_start_to, $dt_stop_from, $dt_stop_to;

    public function __construct(
        int $per_page,
        ?array $channel_id,
        ?array $category_id,
        ?array $package_id,
        ?array $department_id,
        ?array $town_id,
        ?string $dt_start_from,
        ?string $dt_start_to,
        ?string $dt_stop_from,
        ?string $dt_stop_to)
    {
        $this->per_page = $per_page;
        $this->channel_id = $channel_id;
        $this->category_id = $category_id;
        $this->package_id = $package_id;
        $this->department_id = $department_id;
        $this->town_id = $town_id;
        $this->dt_start_from = $dt_start_from;
        $this->dt_start_to = $dt_start_to;
        $this->dt_stop_from = $dt_stop_from;
        $this->dt_stop_to = $dt_stop_to;
    }
}
