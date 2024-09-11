<?php

namespace App\Services\Task\Contracts;

interface CreateTaskServiceContract
{
    /**
     * @param $request
     * @return mixed
     */
    public function execute($request);
}
