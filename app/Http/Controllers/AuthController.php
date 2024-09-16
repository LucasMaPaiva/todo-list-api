<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\Auth\LoginDTO;
use App\DataTransferObjects\Auth\RegisterUserDTO;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Http\Resources\Auth\RegisterUserResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;
use Illuminate\Routing\Controller;
use App\Services\Auth\Contracts\LoginServiceContract;
use App\Services\Auth\Contracts\RegisterUserServiceContract;


class AuthController extends Controller
{

    private LoginServiceContract $loginService;

    private RegisterUserServiceContract $registerUserService;

    public function __construct()
    {
        $this->services();
    }

    public function services() :void
    {
        $this->loginService = app(LoginServiceContract::class);
        $this->registerUserService = app(RegisterUserServiceContract::class);
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        try {
            return self::successResponse(
                data: LoginResource::make(
                    $this->loginService->execute(
                        LoginDTO::fromRequest($request)
                    ),
                ),
                message: __('messages.login.success'),
                status_code: 201
            );
        } catch (ModelNotFoundException $modelNotFoundException) {
            return self::modelNotFoundResponse($modelNotFoundException);
        } catch (InvalidArgumentException $invalidArgumentException) {
            return self::invalidArgumentResponse($invalidArgumentException);
        } catch (Exception $exception) {
            return self::internalServerErrorResponse($exception);
        }
    }

    /**
     * @param RegisterUserRequest $request
     * @return JsonResponse
     */
    public function register(RegisterUserRequest $request) :JsonResponse
    {
        try {

            return self::successResponse(
                data: RegisterUserResource::make(
                    $this->registerUserService->execute(
                        RegisterUserDTO::fromRequest($request)
                    ),
                ),
                message: __('messages.user.created'),
                status_code: 201
            );

        } catch (ModelNotFoundException $modelNotFoundException) {
            return self::modelNotFoundResponse($modelNotFoundException);
        } catch (InvalidArgumentException $invalidArgumentException) {
            return self::invalidArgumentResponse($invalidArgumentException);
        } catch (Exception $exception) {
            return self::internalServerErrorResponse($exception);
        }
    }
}
