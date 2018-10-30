<?php
/**
 * Created by PhpStorm.
 * User: imagina
 * Date: 3/10/2018
 * Time: 5:41 PM
 */

namespace Modules\Iperformers\Events;

use Modules\Iperformers\Entities\Performer;
use Modules\Core\Events\AbstractEntityHook;


class PerformerIsCreated extends AbstractEntityHook
{
    public $entity;
    public  $data;

    /**
     * Create a new event instance.
     *
     * @param $entity
     * @param array $data
     */
    public function __construct($entity,array $data)
    { 
        $this->data=$data;
        $this->entity=$entity;
    }





}