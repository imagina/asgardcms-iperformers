<?php

namespace Modules\Iperformers\Repositories\Cache;

use Modules\Iperformers\Repositories\TypeRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheTypeDecorator extends BaseCacheDecorator implements TypeRepository
{
    public function __construct(TypeRepository $type)
    {
        parent::__construct();
        $this->entityName = 'iperformers.types';
        $this->repository = $type;
    }
}
