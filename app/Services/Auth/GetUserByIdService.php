<?php

namespace App\Services\Auth;

use App\Repository\UserRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repository\Contracts\UserRepositoryContract;

class GetUserByIdService implements Contracts\GetUserByIdServiceContract
{

    private UserRepositoryContract $userRepository;

    public function __construct()
    {
        $this->repositories();
    }

    public function repositories()
    {
        $this->userRepository = app(UserRepositoryContract::class);
    }

    public function execute($id)
    {
        try {

            $user = $this->userRepository->find($id);

            if (empty($user)) {
                throw new ModelNotFoundException(__('message.user_not_found'));
            }

            return $user;

        } catch (ModelNotFoundException $modelNotFoundException) {
            throw $modelNotFoundException;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
