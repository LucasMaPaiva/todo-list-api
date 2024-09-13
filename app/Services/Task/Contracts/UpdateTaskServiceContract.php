<?php

namespace App\Services\Task\Contracts;

interface UpdateTaskServiceContract
{
    /**
     * @param $id
     * @param $request
     * @return mixed
     */
    public function execute($id, $request): mixed;
}
