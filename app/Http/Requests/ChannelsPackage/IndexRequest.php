<?php

namespace App\Http\Requests\ChannelsPackage;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'channel_id' => 'array|nullable',
            'category_id' => 'array|nullable',
            'package_id' => 'array|nullable',
            'department_id' => 'array|nullable',
            'town_id' => 'array|nullable',
            'dt_start_from' => 'string|nullable',
            'dt_start_to' => 'string|nullable',
            'dt_stop_from' => 'string|nullable',
            'dt_stop_to' => 'string|nullable',
        ];
    }

    public function attributes()
    {
        return [
            'channel_id' => 'Канал',
            'package_id' => 'Пакет',
            'department_id' => 'Филиал',
            'town_id' => 'Город',
            'dt_start_from' => 'Дата начала',
            'dt_start_to' => 'Дата начала',
            'dt_stop_from' => 'Дата окончания',
            'dt_stop_to' => 'Дата окончания',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения.',
        ];
    }
}
