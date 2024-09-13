<?php

namespace App\Services\Auth\Contracts;

use Symfony\Component\HttpFoundation\JsonResponse;

class LoginService implements LoginServiceContract
{
    public function execute($request) :JsonResponse
    {
        dd('entrei');
    }
}
