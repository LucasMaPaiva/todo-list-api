<?php

namespace App\Services\Contracts;

use App\DataTransferObjects\TaskSituation\CreateTaskSituationDTO;

interface CreateTaskSituationServiceContract
{
    public function execute(CreateTaskSituationDTO $taskSituationDTO);
}
