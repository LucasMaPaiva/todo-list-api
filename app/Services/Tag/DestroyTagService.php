<?php

namespace App\Services\Tag;

use App\Services\Tag\Contracts\GetTagByIdServiceContract;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DestroyTagService implements Contracts\DestroyTagServiceContract
{

    private GetTagByIdServiceContract $getTagByIdService;

    public function __construct()
    {
        $this->services();
    }

    public function services() :void
    {
        $this->getTagByIdService = app(GetTagByIdServiceContract::class);
    }

    /**
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function execute($id) :mixed
    {
        try {
            $tag = $this->getTagByIdService->execute($id);

            return $tag->delete();

        } catch (ModelNotFoundException $modelNotFoundException) {
            throw $modelNotFoundException;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
