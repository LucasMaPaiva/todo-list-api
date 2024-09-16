<?php

namespace App\Repository;

use App\Base\Repository\BaseRepository;
use App\Models\Tag;
use App\Repository\Contracts\TagRepositoryContract;

class TagRepository extends BaseRepository implements Contracts\TagRepositoryContract
{
    public function __construct
    (
        private Tag $tag
    )
    {
        parent::__construct($tag);
        $this->model = $tag;
    }
}
