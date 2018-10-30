<?php
namespace Modules\Iperformers\Events\Handlers;

use Modules\Iperformers\Events\PerformerWasCreated;
use Modules\Iperformers\Repositories\PerformerRepository;


class SavePerformerImage
{
    private $performer;
    public function __construct(PerformerRepository $performer)
    {
        $this->performer = $performer;
    }
    public function handle(PerformerWasCreated $event)
    {
        $id = $event->entity->id;
        if (!empty($event->data['mainimage'])) {
            dd('hola');
            $mainimage = saveImage($event->data['mainimage'], "assets/iperformers/performer/" . $id . ".jpg");
            if(isset($event->data['options'])){
                $options=(array)$event->data['options'];
            }else{$options = array();}
            $options["mainimage"] = $mainimage;
            $event->data['options'] = json_encode($options);
        }else{
            $event->data['options'] = json_encode($event->data['options']);
        }
        $this->performer->update($event->entity, $event->data);
    }

}