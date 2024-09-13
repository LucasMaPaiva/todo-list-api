<?php

namespace App\DataTransferObjects\Task;

use App\Http\Requests\Task\UpdateTaskRequest;
use Spatie\LaravelData\Data;

class UpdateTaskDTO extends Data
{

    /**
     * @param $title
     * @param $description
     * @param $task_situation_id
     */
    public function __construct(
        public $title,
        public $description,
        public $task_situation_id,
    )
    {
    }


    /**
     * @param UpdateTaskRequest $request
     * @return UpdateTaskDTO
     */
    public static function fromRequest(UpdateTaskRequest $request): UpdateTaskDTO {
        return new self(
            title: $request->validated('title'),
            description: $request->validated('description'),
            task_situation_id: $request->validated('task_situation_id')
        );
    }
}
