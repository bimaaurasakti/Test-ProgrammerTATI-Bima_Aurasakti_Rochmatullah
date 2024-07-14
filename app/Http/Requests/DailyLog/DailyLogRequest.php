<?php

namespace App\Http\Requests\DailyLog;

use Illuminate\Foundation\Http\FormRequest;

class DailyLogRequest extends FormRequest
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
        $method = strtolower($this->method());
        $generalRules = [
            'user_id' => 'required|exists:users,id',
            'log_date' => 'required|date',
            'activity' => 'required',
        ];

        switch ($method) {
            case 'post':
                $rules = [
                    ...$generalRules,
                ];
                break;
            case 'patch':
                $rules = [
                    ...$generalRules,
                ];
                break;
        }

        return $rules;
    }
}
