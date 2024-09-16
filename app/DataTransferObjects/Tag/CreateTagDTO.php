<?php

namespace App\DataTransferObjects\Tag;

use App\Http\Requests\Tag\CreateTagRequest;
use Spatie\LaravelData\Data;

class CreateTagDTO extends Data
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
     * @param CreateTagRequest $request
     * @return CreateTagDTO
     */
    public static function fromRequest(CreateTagRequest $request): CreateTagDTO {
        return new self(
            name: $request->validated('name'),
        );
    }
}
