<?php

namespace App\Http\Requests\Auth;

use App\Base\Traits\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest {

    use Response;

    public function rules(): array {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ];
    }

    public function authorize(): bool {
        return true;
    }

    public function messages(): array {
        return [
            'name.required' => __('validation.required', ['attribute' => 'nome de usuário']),
            'email.required' => __('validation.required', ['attribute' => 'email']),
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
