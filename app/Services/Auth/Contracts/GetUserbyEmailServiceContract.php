<?php

namespace App\Services\Auth\Contracts;

interface GetUserbyEmailServiceContract
{
    public function execute(string $email);
}
