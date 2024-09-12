<?php

namespace App\Http\Controllers\API\V1;

use App\DataTransferObjects\TaskSituation\CreateTaskSituationDTO;
use Illuminate\Routing\Controller;
use App\Http\Requests\TaskSituation\CreateTaskSituationRequest;
use App\Http\Resources\TaskSituation\NewTaskSituationResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\Contracts\CreateTaskSituationServiceContract;
use InvalidArgumentException;

class TaskSituationController extends Controller
{

    /**
     * @var CreateTaskSituationServiceContract
     */
    private CreateTaskSituationServiceContract $createTaskSituationService;

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
        $this->createTaskSituationService = app(CreateTaskSituationServiceContract::class);
    }

    /**
     * @param CreateTaskSituationRequest $request
     * @return JsonResponse
     */
    public function store(CreateTaskSituationRequest $request) :JsonResponse
    {
        try {
            return self::successResponse(
                data: NewTaskSituationResource::make(
                    $this->createTaskSituationService->execute(
                        CreateTaskSituationDTO::fromRequest($request)
                    )
                ),
                message: __('messages.success.store_message', ['scope' => 'Situação da Tarefa']),
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
