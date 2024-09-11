<?php

namespace App\Http\Requests\Task;

use App\Base\Traits\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest {

    use Response;

    public function rules(): array {
        return [
            'title' => 'required|text',
            'description' => 'sometimes|text',
            'task_situation_id' => 'required|integer',
        ];
    }

    public function authorize(): bool {
        return true;
    }

    public function messages(): array {
        return [
            'title.required' => __('validation.required', ['attribute' => 'título da tarefa']),
            'task_situation_id.required' => __('validation.required', ['attribute' => 'situação da tarefa']),
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
