<?php

namespace App\Services\Auth\Contracts;

use App\DataTransferObjects\Auth\LoginDTO;

interface LoginServiceContract
{
    public function execute(LoginDTO $loginDTO);
}
