<?php

namespace App\Http\Controllers\API\V1;

use App\DataTransferObjects\Tag\CreateTagDTO;
use App\Http\Requests\Tag\CreateTagRequest;
use App\Http\Resources\Tag\CreateTagResource;
use App\Services\Tag\CreateTagService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use InvalidArgumentException;
use App\Services\Tag\Contracts\CreateTagServiceContract;

class TagController extends Controller
{

    private CreateTagServiceContract $createTagService;

    public function __construct()
    {
        $this->services();
    }

    public function services() :void
    {
        $this->createTagService = app(CreateTagServiceContract::class);
    }

    /**
     * @param CreateTagRequest $request
     * @return JsonResponse
     */
    public function store(CreateTagRequest $request) :JsonResponse
    {
        try {
            return self::successResponse(
                data: CreateTagResource::make(
                    $this->createTagService->execute(CreateTagDTO::fromRequest($request))
                ),
                message: __('messages.success.store_message', ['scope' => 'Etiqueta']),
                status_code: 201
            );
        } catch (InvalidArgumentException $invalidArgumentException) {
            return self::invalidArgumentResponse($invalidArgumentException);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return self::modelNotFoundResponse($modelNotFoundException);
        } catch (Exception $exception) {
            return self::internalServerErrorResponse($exception);
        }
    }
}
