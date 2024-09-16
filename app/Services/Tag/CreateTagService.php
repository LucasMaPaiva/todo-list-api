<?php

namespace App\Services\Tag;

use App\Models\Tag;
use App\Repository\TagRepository;
use App\Services\Tag\Contracts\CreateTagServiceContract;
use phpDocumentor\Reflection\Exception;
use App\Repository\Contracts\TagRepositoryContract;

class CreateTagService implements Contracts\CreateTagServiceContract
{

    private TagRepositoryContract $tagRepository;

    public function __construct()
    {
        $this->repositories();
    }

    public function repositories() :void
    {
        $this->tagRepository = app(TagRepository::class);
    }
    public function execute($createTagDTO)
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
