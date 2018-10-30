<?php

namespace Modules\Iperformers\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface PerformerRepository extends BaseRepository
{

    public function whereType($id);

    public function wherebyFilter($page, $take, $filter, $include);

}
