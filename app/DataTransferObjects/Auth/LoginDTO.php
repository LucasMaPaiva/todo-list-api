<?php

namespace App\DataTransferObjects\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Spatie\LaravelData\Data;

class LoginDTO extends Data
{

    /**
     * @param $name
     * @param $password
     */
    public function __construct(
        public $name,
        public $password,
    )
    {
    }


    /**
     * @param LoginRequest $request
     * @return LoginDTO
     */
    public static function fromRequest(LoginRequest $request): LoginDTO {
        return new self(
            name: $request->validated('name'),
            password: $request->validated('password')
        );
    }
}
