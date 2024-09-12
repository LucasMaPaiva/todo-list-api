<?php

namespace App\Repository;

use App\Base\Repository\BaseRepository;
use App\Models\TaskSituation;
use App\Repository\Contracts\TaskSituationRepositoryContract;

class TaskSituationRepository extends BaseRepository implements Contracts\TaskSituationRepositoryContract
{
    public function __construct(
        private TaskSituation $taskSituation
    ) {
        parent::__construct($taskSituation);
        $this->model = $taskSituation;
    }
}
