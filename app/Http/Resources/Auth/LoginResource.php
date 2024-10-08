<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'access_token' => $this['access_token'],
            'user' => [
                'id' => $this['user']['id'],
            ],
        ];
    }
}
