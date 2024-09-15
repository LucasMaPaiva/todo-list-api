<?php

namespace App\Services\Auth\Contracts;

interface LoginServiceContract
{
    public function execute($loginDTO);
}
