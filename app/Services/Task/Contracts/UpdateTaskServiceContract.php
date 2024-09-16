<?php

namespace App\Services\Task\Contracts;

use App\DataTransferObjects\Task\UpdateTaskDTO;

interface UpdateTaskServiceContract
{
    /**
     * @param $id
     * @param $request
     * @return mixed
     */
    public function execute($id, UpdateTaskDTO $updateTaskDTO): mixed;
}
