<?php

namespace App\Repository\Contracts;

use App\Base\Repository\Contracts\BaseRepositoryContract;

interface TaskRepositoryContract extends BaseRepositoryContract
{
    public function getTaskByUserId($user_id);
}
