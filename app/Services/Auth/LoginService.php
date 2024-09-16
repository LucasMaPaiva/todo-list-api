<?php

namespace App\Services\Auth;

use App\DataTransferObjects\Auth\LoginDTO;
use App\Services\Auth\Contracts\LoginServiceContract;
use Exception;
use App\Services\Auth\Contracts\GetUserbyEmailServiceContract;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

class LoginService implements LoginServiceContract
{

    private GetUserbyEmailServiceContract $getUserbyEmailService;

    public function __construct()
    {
        $this->services();
    }

    public function services()
    {
        $this->getUserbyEmailService = app(GetUserbyEmailServiceContract::class);
    }

    /**
     * @param LoginDTO $loginDTO
     * @return mixed
     * @throws Exception
     */
    public function execute(LoginDTO $loginDTO)
    {
        try {
            $user = $this->getUserbyEmailService->execute(
                email: $loginDTO->email,
            );

            $this->checkIfCanAccess(
                password: $loginDTO->password,
                user: $user
            );

            $token = $this->generateToken($user);

            return  [
                'access_token' => $token,
                'user' => $user,
            ];


        } catch (InvalidArgumentException $invalidArgumentException) {
            throw $invalidArgumentException;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    private function checkIfCanAccess($password, mixed $user) {
        try {
            if (!$user || !Hash::check($password, $user->password)) {
                throw new InvalidArgumentException(__('message.user.not_found'));
            }
        } catch (InvalidArgumentException $invalidArgumentException) {
            throw $invalidArgumentException;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    private function generateToken($user): mixed {
        try {
            return $user->createToken(
                name: 'user_token',
                abilities: []
            )->plainTextToken;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
