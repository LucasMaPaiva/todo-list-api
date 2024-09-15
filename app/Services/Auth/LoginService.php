<?php

namespace App\Services\Auth;

use App\Services\Auth\Contracts\LoginServiceContract;
use Exception;
use App\Services\Auth\Contracts\GetUserbyNameServiceContract;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

class LoginService implements LoginServiceContract
{

    private GetUserbyNameServiceContract $getUserbyNameService;

    public function __construct()
    {
        $this->services();
    }

    public function services()
    {
        $this->getUserbyNameService = app(GetUserbyNameServiceContract::class);
    }

    /**
     * @param $loginDTO
     * @return array
     * @throws Exception
     */
    public function execute($loginDTO) : array
    {
        try {
            $user = $this->getUserbyNameService->execute(
                name: $loginDTO->email,
            );
            $this->checkIfCanAccess(
                password: $loginDTO->password,
                user: $user
            );

            $token = $this->generateToken($user);
            return [
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
