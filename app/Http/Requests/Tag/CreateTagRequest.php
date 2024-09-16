<?php

namespace App\Http\Requests\Tag;

use App\Base\Traits\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateTagRequest extends FormRequest {

    use Response;

    public function rules(): array {
        return [
            'name' => 'required',
        ];
    }

    public function authorize(): bool {
        return true;
    }

    public function messages(): array {
        return [
            'name.required' => __('validation.required', ['attribute' => 'nome da etiqueta']),
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
