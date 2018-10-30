<?php

namespace Modules\Iperformers\Repositories\Cache;

use Modules\Iperformers\Repositories\ServiceRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheServiceDecorator extends BaseCacheDecorator implements ServiceRepository
{
    public function __construct(ServiceRepository $service)
    {
        parent::__construct();
        $this->entityName = 'iperformers.services';
        $this->repository = $service;
    }
}
