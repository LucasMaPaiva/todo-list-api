<?php

namespace App\Services;

use App\Models\TaskSituation;
use App\Services\Contracts\CreateTaskSituationServiceContract;
use App\DataTransferObjects\CreateTaskSituationDTO;

class CreateTaskSituationService implements Contracts\CreateTaskSituationServiceContract
{
    /**
     * @param $request
     * @return TaskSituation
     */
     public function execute($request): TaskSituation
     {
        $itemName = $request->input('name');


        if (empty($itemName)) {
            throw new \InvalidArgumentException('O campo name não pode ser vazio.');
        }

        $taskSituation = new TaskSituation();
        $taskSituation->name = $itemName;

        $taskSituation->save();

        return $taskSituation;
    }
}
