<?php

namespace App\Dto;

class ChannelsPackageDTO
{
    public int $channel_id, $package_id, $department_id, $town_id;
    public ?string $dt_start, $dt_stop;

    public function __construct(int $channel_id, int $package_id, int $department_id, int $town_id, ?string $dt_start, ?string $dt_stop)
    {
        $this->channel_id = $channel_id;
        $this->package_id = $package_id;
        $this->department_id = $department_id;
        $this->town_id = $town_id;
        $this->dt_start = $dt_start;
        $this->dt_stop = $dt_stop;
    }
}
