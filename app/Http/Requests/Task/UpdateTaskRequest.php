<?php

namespace App\Http\Requests\Task;

use App\Base\Traits\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest {

    use Response;

    public function rules(): array {
        return [
            'title' => 'sometimes',
            'description' => 'sometimes',
            'task_situation_id' => 'sometimes',
        ];
    }

    public function authorize(): bool {
        return true;
    }

    public function messages(): array {
        return [
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
