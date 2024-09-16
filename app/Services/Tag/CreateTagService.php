<?php

namespace App\Services\Tag;

use App\Models\Tag;
use App\Repository\TagRepository;
use App\Services\Tag\Contracts\CreateTagServiceContract;
use phpDocumentor\Reflection\Exception;
use App\Repository\Contracts\TagRepositoryContract;

class CreateTagService implements Contracts\CreateTagServiceContract
{

    /**
     * @var TagRepositoryContract
     */
    private TagRepositoryContract $tagRepository;

    public function __construct()
    {
        $this->repositories();
    }

    /**
     * @return void
     */
    public function repositories() :void
    {
        $this->tagRepository = app(TagRepository::class);
    }

    /**
     * @param $createTagDTO
     * @return mixed
     * @throws Exception
     */
    public function execute($createTagDTO) :mixed
    {
        try {
            return $this->tagRepository->create([
                'name' => $createTagDTO->name,
            ]);
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
