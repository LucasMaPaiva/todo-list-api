<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\Auth\LoginDTO;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\LoginResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;
use Illuminate\Routing\Controller;
use App\Services\Auth\Contracts\LoginServiceContract;


class AuthController extends Controller
{

    private LoginServiceContract $loginService;

    public function __construct()
    {
        $this->services();
    }

    public function services() :void
    {
        $this->loginService = app(LoginServiceContract::class);
    }

    /**
     * @param LoginRequest $request
     * @return mixed
     */
    public function login(LoginRequest $request) : mixed
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
}
