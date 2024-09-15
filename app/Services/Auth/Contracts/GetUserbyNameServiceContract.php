<?php

namespace App\Services\Auth\Contracts;

interface GetUserbyNameServiceContract
{
    public function execute(string $name);
}
