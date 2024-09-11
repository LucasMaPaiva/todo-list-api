<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Services\Contracts\CreateTaskSituationServiceContract;

class TaskSituationController extends Controller
{

    private CreateTaskSituationServiceContract $taskSituationService;

    public function __construct()
    {
        $this->services();
    }

    public function services() :void
    {
        $this->taskSituationService = app(CreateTaskSituationServiceContract::class);
    }
    /**
     * @param Request $request
     * @return void
     */
    public function store(Request $request): void
    {
            $this->taskSituationService->execute($request);
    }
}
