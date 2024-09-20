<?php

namespace App\Services\Task\Contracts;

interface ListTaskByUserServiceContract
{
    public function execute($user_id);
}
