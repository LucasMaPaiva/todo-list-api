<?php

namespace App\Services\Task\Contracts;

use Illuminate\Http\Request;

interface CreateTaskServiceContract
{
    public function execute(Request $request);
}
