<?php

namespace App\Services\Tag\Contracts;

use App\Repository\Contracts\TagRepositoryContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use phpDocumentor\Reflection\Exception;

class GetTagByIdService implements GetTagByIdServiceContract
{

    private TagRepositoryContract $tagRepository;

    public function __construct()
    {
        $this->repositories();
    }

    public function repositories() :void
    {
        $this->tagRepository = app(TagRepositoryContract::class);
    }

    /**
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function execute($id) : mixed
    {
        try {

            $tag = $this->tagRepository->find($id);

            if (empty($tag)) {
                throw new ModelNotFoundException(__('messages.error.not_found', ['scope' => 'Etiqueta']));
            }

            return $tag;

        } catch (ModelNotFoundException $modelNotFoundException) {
            throw $modelNotFoundException;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
