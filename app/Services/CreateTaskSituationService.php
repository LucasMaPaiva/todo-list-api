<?php

namespace App\Services;

use App\DataTransferObjects\TaskSituation\CreateTaskSituationDTO;
use App\Models\TaskSituation;
use App\Repository\Contracts\TaskSituationRepositoryContract;
use Exception;
use Illuminate\Support\Facades\DB;

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
     * @param CreateTaskSituationDTO $taskSituationDTO
     * @return TaskSituation
     * @throws Exception
     */
     public function execute(CreateTaskSituationDTO $taskSituationDTO): TaskSituation
     {
         try{
             DB::beginTransaction();
             $taskSituation = $this->taskSituationRepository->create([
                 'name' => $taskSituationDTO->name
             ]);
             DB::commit();
             return $taskSituation;
         } catch (Exception $exception) {
             DB::rollBack();
             throw $exception;
         }
    }
}
