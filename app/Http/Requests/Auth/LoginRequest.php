<?php

namespace App\Http\Requests\Auth;

use App\Base\Traits\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest {

    use Response;

    public function rules(): array {
        return [
            'email' => 'required',
            'password' => 'required'
        ];
    }

    public function authorize(): bool {
        return true;
    }

    public function messages(): array {
        return [
            'email.required' => __('validation.required', ['attribute' => 'email de usuário']),
            'password.required' => __('validation.required', ['attribute' => 'senha']),
        ];
    }

    /**
     * @param Validator $validator
     * @return mixed|void
     */
    protected function failedValidation(Validator $validator) {
        return self::failedValidationResponse($validator);
    }
}
