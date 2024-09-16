<?php

namespace App\Services\Tag\Contracts;

interface CreateTagServiceContract
{
    /**
     * @param $createTagDTO
     * @return mixed
     */
    public function execute($createTagDTO) :mixed;
}
