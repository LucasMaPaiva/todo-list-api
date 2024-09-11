<?php

namespace App\Services;

use App\Models\TaskSituation;
use App\Services\Contracts\CreateTaskSituationServiceContract;
use App\DataTransferObjects\CreateTaskSituationDTO;
use App\Repository\Contracts\TaskSituationRepositoryContract;
use Exception;

class CreateTaskSituationService implements Contracts\CreateTaskSituationServiceContract
{

    private TaskSituationRepositoryContract $taskSituationRepository;

    public function __construct()
    {
        $this->repository();
    }

    public function repository() :void
    {
        $this->taskSituationRepository = app(TaskSituationRepositoryContract::class);
    }

    /**
     * @param $request
     * @return TaskSituation
     * @throws Exception
     */
     public function execute($request): TaskSituation
     {
         try {
             return $this->taskSituationRepository->create([
                 'name' => $request->name
             ]);
         } catch (Exception $exception) {
             $this->logException(
                 caller: __METHOD__,
                 exception: $exception,
             );
             throw $exception;
         }
    }
}
