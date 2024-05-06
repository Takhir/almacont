<?php

namespace App\Http\Requests\Subscribe;

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
            'per_page' => '20',
            'period_id' => 'nullable|integer',
            'town_id' => 'nullable|integer',
            'package_id' => 'nullable|integer',
        ];
    }

    public function attributes()
    {
        return [
            'period_id' => 'Период',
            'town_id' => 'Город',
            'package_id' => 'Пакет',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения.',
        ];
    }
}
