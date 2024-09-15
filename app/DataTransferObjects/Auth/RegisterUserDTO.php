<?php

namespace App\DataTransferObjects\Auth;

use App\Http\Requests\Auth\RegisterUserRequest;
use Spatie\LaravelData\Data;

class RegisterUserDTO extends Data
{

    /**
     * @param $name
     * @param $email
     * @param $password
     */
    public function __construct(
        public $name,
        public $email,
        public $password,
    )
    {
    }


    /**
     * @param RegisterUserRequest $request
     * @return RegisterUserDTO
     */
    public static function fromRequest(RegisterUserRequest $request): RegisterUserDTO {
        return new self(
            name: $request->validated('name'),
            email: $request->validated('email'),
            password: $request->validated('password')
        );
    }
}
