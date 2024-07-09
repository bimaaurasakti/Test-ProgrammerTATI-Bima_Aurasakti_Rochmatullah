<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->is_active == 'on' ? 1 : 0
        ]);
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
            'username' => 'max:20',
            'phone_number' => 'min:10|max:13',
            'photo_profile_file' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];

        switch ($method) {
            case 'post':
                $rules = [
                    ...$generalRules,
                    'password' => 'required|confirmed|min:8',
                    'email' => 'required|email|unique:users',
                ];
                break;
            case 'patch':
                $user_id = $this->route()->user->id;
                $rules = [
                    ...$generalRules,
                    'password' => 'confirmed|min:8|nullable',
                    'email' => 'required|max:191|email|unique:users,email,'.$user_id,
                ];
                break;
        }

        return $rules;
    }
}
