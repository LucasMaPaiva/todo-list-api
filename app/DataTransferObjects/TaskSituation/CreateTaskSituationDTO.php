<?php

namespace App\DataTransferObjects\TaskSituation;

use App\Http\Requests\TaskSituation\CreateTaskSituationRequest;
use Spatie\LaravelData\Data;

class CreateTaskSituationDTO extends Data
{

    /**
     * @param $name
     */
    public function __construct(
        public $name,
    )
    {
    }


    /**
     * @param CreateTaskSituationRequest $request
     * @return CreateTaskSituationDTO
     */
    public static function fromRequest(CreateTaskSituationRequest $request): CreateTaskSituationDTO {
        return new self(
            name: $request->validated('name')
        );
    }
}
