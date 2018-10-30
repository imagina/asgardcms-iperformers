<?php

namespace Modules\Iperformers\Repositories\Cache;

use Modules\Iperformers\Repositories\PerformerRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CachePerformerDecorator extends BaseCacheDecorator implements PerformerRepository
{
    public function __construct(PerformerRepository $performer)
    {
        parent::__construct();
        $this->entityName = 'iperformers.performers';
        $this->repository = $performer;
    }

    public function whereType($id)
    {
        return $this->remember(function () use ($id) {
            return $this->repository->whereType($id);
        });
    }

    public function wherebyFilter($page, $take, $filter, $include)
    {
        return $this->remember(function () use ($page, $take, $filter, $include) {
            return $this->repository->wherebyFilter($page, $take, $filter, $include);
        });
    }
}
