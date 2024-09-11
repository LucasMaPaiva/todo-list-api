<?php

namespace App\DataTransferObjects\Task;

use App\Http\Requests\Task\CreateTaskRequest;
use Spatie\DataTransferObject\DataTransferObject;

class CreateTaskDTO extends DataTransferObject
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
     * @param CreateTaskRequest $request
     * @return CreateTaskDTO
     */
    public static function fromRequest(CreateTaskRequest $request): CreateTaskDTO {
        return new self(
            title: $request->validated('title'),
            description: $request->validated('description'),
            task_situation_id: $request->validated('task_situation_id')
        );
    }
}
