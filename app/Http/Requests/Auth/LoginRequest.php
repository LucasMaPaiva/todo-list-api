<?php

namespace App\Http\Requests\Auth;

use App\Base\Traits\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest {

    use Response;

    public function rules(): array {
        return [
            'name' => 'required',
            'password' => 'required'
        ];
    }

    public function authorize(): bool {
        return true;
    }

    public function messages(): array {
        return [
            'name.required' => __('validation.required', ['attribute' => 'nome de usuário']),
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
