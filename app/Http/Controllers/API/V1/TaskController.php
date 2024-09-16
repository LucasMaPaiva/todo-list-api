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
use App\Services\Task\Contracts\UpdateTaskServiceContract;
use App\DataTransferObjects\Task\UpdateTaskDTO;
use App\Services\Task\Contracts\DeleteTaskServiceContract;

class TaskController extends Controller
{

    /**
     * @var CreateTaskServiceContract
     */
    private CreateTaskServiceContract $createTaskService;

    /**
     * @var UpdateTaskServiceContract
     */
    private UpdateTaskServiceContract $updateTaskService;

    /**
     * @var DeleteTaskServiceContract
     */
    private DeleteTaskServiceContract $deleteTaskService;

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
    public function services(): void
    {
        $this->createTaskService = app(CreateTaskServiceContract::class);
        $this->updateTaskService = app(UpdateTaskServiceContract::class);
        $this->deleteTaskService = app(DeleteTaskServiceContract::class);
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

    /**
     * @param $id
     * @param UpdateTaskRequest $request
     * @return JsonResponse
     */
    public function update($id, UpdateTaskRequest $request): JsonResponse
    {
        try {
            return self::successResponse(
                data: UpdateTaskResource::make(
                    $this->updateTaskService->execute(
                        $id,
                        UpdateTaskDTO::fromRequest($request)
                    ),
                ),
                message: __('messages.success.update_message', ['scope' => 'Tarefa']),
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
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id) :JsonResponse
    {
        try {

            return self::successResponse(
                data: $this->deleteTaskService->execute($id),
                message: __('messages.success.delete_message', ['scope' => 'Tarefa']),
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
