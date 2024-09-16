<?php

namespace App\Services\Tag\Contracts;

use App\DataTransferObjects\Tag\CreateTagDTO;

interface CreateTagServiceContract
{
    /**
     * @param $createTagDTO
     * @return mixed
     */
    public function execute(CreateTagDTO $createTagDTO) :mixed;
}
