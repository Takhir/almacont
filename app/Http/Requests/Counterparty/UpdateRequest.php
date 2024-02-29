<?php

namespace App\Http\Requests\Counterparty;

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
            'name' => 'required',
            'bin' => 'required|max:12',
            'resident' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Контрагент',
            'bin' => 'БИН',
            'resident' => 'Резидент РК',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения.',
            'max' => 'Поле :attribute не может содержать более :max символов.',
        ];
    }
}
