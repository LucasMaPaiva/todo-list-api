<?php

namespace App\Http\Resources\Task;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewTaskResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'task_situation_id' => $this->task_situation_id,
        ];
    }
}
