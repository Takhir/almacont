<?php

namespace App\Imports;

use App\Models\Channel;
use App\Services\ChannelCategoryService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class ChannelsImport implements ToCollection
{
    private ChannelCategoryService $channelCategoryService;

    public function __construct()
    {
        $this->channelCategoryService = app(ChannelCategoryService::class);
    }
    public function collection(Collection $rows)
    {
        $rows->shift();

        $rules = [
            '*.0' => 'required',
            '*.2' => 'required',
        ];

        $messages = [];

        foreach ($rows as $key => $row) {
            $rowNumber = $key + 2;
            $messages["$key.0.required"] = __('validation.required_import', ['attribute' => 'Канал', 'line' => $rowNumber]);
            $messages["$key.2.required"] = __('validation.required_import', ['attribute' => 'Тематика канала', 'line' => $rowNumber]);
        }

        Validator::make($rows->toArray(), $rules, $messages)->validate();

        foreach ($rows as $row)
        {
            $data = [
                'name' => trim($row[0]),
                'description' => empty($row[1]) ? null : trim($row[1]),
            ];
            if (is_null($this->channelCategoryService->getIdByName(trim($row[2])))) {
                $data['theme'] = $row[2];
            } else {
                $data['category_id'] = $this->channelCategoryService->getIdByName(trim($row[2]));
            }

            Channel::create($data);
        }
    }
}
