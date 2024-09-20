<?php

namespace App\Services\Auth\Contracts;

interface GetUserByIdServiceContract
{
    public function execute($id);
}
