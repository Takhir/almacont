<?php

namespace App\Http\Requests\Currency;

use App\Services\PeriodService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    private PeriodService $periodService;

    public function __construct(PeriodService $periodService) {
        $this->periodService = $periodService;
    }

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
        $periodId = $this->period_id;

        return [
            'name' => [
                'required',
                Rule::unique('currencies')->where(function ($query) use ($periodId) {
                    return $query->where('period_id', $periodId)->where('deleted', 0);
                })->ignore($this->get('id')),
            ],
            'period_id' => 'required',
            'exchange_start' => 'required',
            'exchange_stop' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Валюта',
            'period_id' => 'Период',
            'exchange_start' => 'Курсы на начало периода',
            'exchange_stop' => 'Курсы на конец периода',
        ];
    }
    public function messages()
    {
        return [
            'name.unique' => 'Валюта (:input) за период (' . $this->periodService->getNameById($this->period_id) . ') уже существует.',
            'required' => 'Поле :attribute обязательно для заполнения.',
        ];
    }
}
