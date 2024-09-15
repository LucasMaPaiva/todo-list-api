<?php

namespace App\Services\Auth;

use App\Services\Auth\Contracts\GetUserbyNameServiceContract;
use Exception;
use App\Repository\Contracts\UserRepositoryContract;
use InvalidArgumentException;

class GetUserbyNameService implements Contracts\GetUserbyNameServiceContract
{

    private UserRepositoryContract $userRepository;

    public function __construct()
    {
        $this->services();
    }

    public function services() :void
    {
        $this->userRepository = app(UserRepositoryContract::class);
    }
    public function execute(string $name)
    {
        try {

            $name = $this->userRepository->findByColumn('name', $name);
            if (!$name) {
                throw new InvalidArgumentException(__('validation.custom.user.not-found-by-username'));
            }
            return $name;

        } catch (InvalidArgumentException $invalidArgumentException) {
            throw $invalidArgumentException;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
