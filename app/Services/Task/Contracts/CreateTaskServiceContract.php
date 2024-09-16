<?php

namespace App\Services\Task\Contracts;

use App\DataTransferObjects\Task\CreateTaskDTO;

interface CreateTaskServiceContract
{
    /**
     * @param $request
     * @return mixed
     */
    public function execute(CreateTaskDTO $createTaskDTO): mixed;
}
