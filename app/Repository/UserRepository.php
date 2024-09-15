<?php

namespace App\Repository;

use App\Base\Repository\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository implements Contracts\UserRepositoryContract
{
    public function __construct(
        private User $user
    ) {
        parent::__construct($user);
        $this->model = $user;
    }
}
