<?php

namespace Modules\Iperformers\Presenters;

use Laracasts\Presenter\Presenter;
use Modules\Iperformers\Entities\Status;

class TypePresenter extends Presenter
{
    /**
     * @var \Modules\Iperformers\Entities\Status
     */
    protected $status;
    /**
     * @var \Modules\Iperformers\Repositories\TypeRepository
     */
    private $type;

    public function __construct($entity)
    {
        parent::__construct($entity);
        $this->type = app('Modules\Iperformers\Repositories\TypeRepository');
        $this->status = app('Modules\Iperformers\Entities\Status');
    }

    /**
     * Get the post status
     * @return string
     */
    public function status()
    {
        return $this->status->get($this->entity->status);
    }

    /**
     * Getting the label class for the appropriate status
     * @return string
     */
    public function statusLabelClass()
    {
        switch ($this->entity->status) {
            case Status::INACTIVE:
                return 'bg-red';
                break;

            case Status::ACTIVE:
                return 'bg-green';
                break;

            default:
                return 'bg-red';
                break;
        }
    }
}
