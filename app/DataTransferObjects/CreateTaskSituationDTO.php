<?php

namespace App\DataTransferObjects;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class CreateTaskSituationDTO extends DataTransferObject
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @param Request $request
     * @return CreateTaskSituationDTO
     * @throws UnknownProperties
     */
    public static function fromRequest(Request $request): CreateTaskSituationDTO {
        return new self(
            name: $request->input('name')
        );
    }

    /**
     * @throws UnknownProperties
     */
    public static function fromArray(array $data): CreateTaskSituationDTO
    {
        return new self(
            name: $data['name']
        );
    }
}
