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
        $reportPeriodId = $this->report_period_id;

        return [
            'v_name' => [
                'required',
                Rule::unique('api_fw_valuta')->where(function ($query) use ($reportPeriodId) {
                    return $query->where('report_period_id', $reportPeriodId);
                })->ignore($this->input('id')),
            ],
            'report_period_id' => 'required',
            'n_exchange_start' => 'required',
            'n_exchange_stop' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'v_name' => 'Валюта',
            'report_period_id' => 'Период',
            'n_exchange_start' => 'Курсы на начало периода',
            'n_exchange_stop' => 'Курсы на конец периода',
        ];
    }
    public function messages()
    {
        return [
            'v_name.unique' => 'Валюта (:input) за период (' . $this->periodService->getNameById($this->report_period_id) . ') уже существует.',
            'required' => 'Поле :attribute обязательно для заполнения.',
        ];
    }
}
