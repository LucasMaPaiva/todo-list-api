<?php

namespace App\Http\Resources\TaskSituation;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewTaskSituationResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'name' => $this->title
        ];
    }
}
