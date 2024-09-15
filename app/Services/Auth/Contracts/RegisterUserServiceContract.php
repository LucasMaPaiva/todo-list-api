<?php

namespace App\Services\Auth\Contracts;

use App\DataTransferObjects\Auth\RegisterUserDTO;
use Illuminate\Http\JsonResponse;

interface RegisterUserServiceContract
{

    /**
     * @param RegisterUserDTO $registerUserDTO
     * @return mixed
     */
    public function execute(RegisterUserDTO $registerUserDTO) :mixed;
}
