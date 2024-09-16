<?php

namespace App\Services\Auth;

use App\Services\Auth\Contracts\GetUserbyEmailServiceContract;
use Exception;
use App\Repository\Contracts\UserRepositoryContract;
use InvalidArgumentException;

class GetUserbyEmailService implements Contracts\GetUserbyEmailServiceContract
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
    public function execute(string $email)
    {
        try {

            $email = $this->userRepository->findByColumn('email', $email);
            if (!$email) {
                throw new InvalidArgumentException(__('validation.custom.user.not-found-by-username'));
            }
            return $email;

        } catch (InvalidArgumentException $invalidArgumentException) {
            throw $invalidArgumentException;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
