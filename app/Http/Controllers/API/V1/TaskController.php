<?php

namespace App\Http\Controllers\API\V1;


use App\DataTransferObjects\Task\CreateTaskDTO;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\Task\NewTaskResource;
use App\Http\Resources\Task\UpdateTaskResource;
use App\Services\Task\Contracts\CreateTaskServiceContract;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Routing\Controller;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;

class TaskController extends Controller
{

    /**
     * @var CreateTaskServiceContract
     */
    private CreateTaskServiceContract $createTaskService;

    /**
     *
     */
    public function __construct()
    {
        $this->services();
    }

    /**
     * @return void
     */
    public function services() :void
    {
        $this->createTaskService = app(CreateTaskServiceContract::class);
    }

    /**
     * @param CreateTaskRequest $request
     * @return JsonResponse
     */
    public function store(CreateTaskRequest $request): JsonResponse
    {
        try {
            return self::successResponse(
                data: NewTaskResource::make(
                    $this->createTaskService->execute(
                        CreateTaskDTO::fromRequest($request)
                    )
                ),
                message: __('messages.success.store_message', ['scope' => 'Tarefa']),
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

    public function update($id, UpdateTaskRequest $request)
    {
        try {
            return self::successResponse(
                data: UpdateTaskResource::make(
                    $this->createTaskService->execute(
                        CreateTaskDTO::fromRequest($request)
                    )
                ),
                message: __('messages.success.store_message', ['scope' => 'Tarefa']),
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
