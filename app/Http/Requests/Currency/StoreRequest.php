<?php

namespace App\Http\Requests\Currency;

use App\Services\CurrencyTypeService;
use App\Services\PeriodService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    private PeriodService $periodService;
    private CurrencyTypeService $currencyTypeService;

    public function __construct(PeriodService $periodService, CurrencyTypeService $currencyTypeService) {
        $this->periodService = $periodService;
        $this->currencyTypeService = $currencyTypeService;
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
            'currency_type_id' => [
                'required',
                Rule::unique('currencies')->where(function ($query) use ($periodId) {
                    return $query->where('period_id', $periodId);
                }),
            ],
            'period_id' => 'required',
            'exchange_start' => 'required',
            'exchange_stop' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'currency_type_id' => 'Валюта',
            'period_id' => 'Период',
            'exchange_start' => 'Курсы на начало периода',
            'exchange_stop' => 'Курсы на конец периода',
        ];
    }
    public function messages()
    {
        return [
            'currency_type_id.unique' => 'Валюта (' .$this->currencyTypeService->getNameById($this->currency_type_id) . ') за период (' . $this->periodService->getNameById($this->period_id) . ') уже существует.',
            'required' => 'Поле :attribute обязательно для заполнения.',
        ];
    }
}
