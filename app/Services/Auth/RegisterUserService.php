<?php

namespace App\Services\Auth;

use App\DataTransferObjects\Auth\RegisterUserDTO;
use App\Repository\UserRepository;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class RegisterUserService implements Contracts\RegisterUserServiceContract
{

    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->services();
    }

    /**
     * @return void
     */
    public function services() :void
    {
        $this->userRepository = app(UserRepository::class);
    }

    /**
     * @param RegisterUserDTO $registerUserDTO
     * @return mixed
     * @throws Exception
     */
    public function execute(RegisterUserDTO $registerUserDTO) :mixed
    {
        try {
            DB::beginTransaction();

                $user = $this->createUser($registerUserDTO);

            DB::commit();
            return $user;

        } catch (InvalidArgumentException $invalidArgumentException) {
            DB::rollBack();
            throw $invalidArgumentException;
        } catch (HttpResponseException $httpResponseException) {
            DB::rollBack();
            throw $httpResponseException;
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @param $registerUserDTO
     * @return mixed
     * @throws Exception
     */
    public function createUser($registerUserDTO)
    {
        try {
            $user = $this->userRepository->create([
                'name' => $registerUserDTO->name,
                'email' => $registerUserDTO->email,
                'password' => $this->definePassword(
                    password: $registerUserDTO->password
                )
            ]);

            return $user->fresh();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @param $password
     * @return string|void
     * @throws Exception
     */
    public function definePassword($password)
    {
        try {
            if ($password) {
                return bcrypt($password);
            }
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
