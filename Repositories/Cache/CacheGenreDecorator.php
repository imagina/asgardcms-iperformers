<?php

namespace Modules\Iperformers\Repositories\Cache;

use Modules\Iperformers\Repositories\GenreRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheGenreDecorator extends BaseCacheDecorator implements GenreRepository
{
    public function __construct(GenreRepository $genre)
    {
        parent::__construct();
        $this->entityName = 'iperformers.genres';
        $this->repository = $genre;
    }
}
