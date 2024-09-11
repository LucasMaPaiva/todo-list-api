<?php

namespace App\Http\Controllers\API\V1;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\Task\Contracts\CreateTaskServiceContract;

class TaskController extends Controller
{

    private CreateTaskServiceContract $createTaskService;

    public function __construct()
    {
        $this->service();
    }

    public function service()
    {
        $this->createTaskService = app(CreateTaskServiceContract::class);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function create(Request $request): void
    {
        $this->createTaskService->execute($request);
    }
}
