<?php

namespace App\Services\Tag\Contracts;

interface GetTagByIdServiceContract
{

    /**
     * @param $id
     * @return mixed
     */
    public function execute($id) :mixed;
}
