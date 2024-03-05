<?php

namespace App\Http\Requests\AgreementsCard;

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
            'channel_id' => 'numeric|required',
            'counterparty_id' => 'numeric|required',
            'sum' => 'required',
            'currency_id' => 'required',
            'period_id' => 'required',
            'currency_presence' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'channel_id' => 'Канал',
            'counterparty_id' => 'Контрагент',
            'sum' => 'Сумма',
            'currency_id' => 'Валюта',
            'period_id' => 'Период',
            'currency_presence' => 'Тип курса',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения.',
        ];
    }
}
