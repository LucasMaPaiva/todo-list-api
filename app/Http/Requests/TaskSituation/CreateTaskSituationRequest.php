<?php

namespace App\Http\Requests\TaskSituation;

use App\Base\Traits\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateTaskSituationRequest extends FormRequest {

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
            'name.required' => __('validation.required', ['attribute' => 'nome da situação'])
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
