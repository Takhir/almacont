<?php

namespace App\Http\Requests\Channel;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Канал',
            'description' => 'Дополнительная информация',
            'category_id' => 'Тематика канала',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения.',
        ];
    }
}
