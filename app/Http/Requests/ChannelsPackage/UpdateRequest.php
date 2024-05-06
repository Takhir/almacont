<?php

namespace App\Http\Requests\ChannelsPackage;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'channel_id' => 'integer|required',
            'package_id' => 'integer|required',
            'all_department' => 'nullable|in:on',
            'department_id' => 'integer|nullable',
            'town_id' => 'integer|nullable',
            'dt_start' => 'nullable|string',
            'dt_stop' => 'nullable|string',
        ];
    }

    public function attributes()
    {
        return [
            'channel_id' => 'Канал',
            'package_id' => 'Пакет',
            'department_id' => 'Филиал',
            'town_id' => 'Город',
            'dt_start' => 'Дата начала',
            'dt_stop' => 'Дата окончания',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения.',
        ];
    }
}
