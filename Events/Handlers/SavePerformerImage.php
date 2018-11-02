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
            $mainimage = saveImage($event->data['mainimage'], "assets/iperformers/performer/" . $id . ".jpg");
            if(isset($event->data['options'])){
                $options=(array)$event->data['options'];
            }else{$options = array();}
            $options["mainimage"] = $mainimage;
            if (!empty($event->data['gallery']) && !empty($id)) {
                if (count(\Storage::disk('publicmedia')->files('assets/iperformers/performer/gallery/' . $event->data['gallery']))) {
                    \File::makeDirectory('assets/iperformers/performer/gallery/' . $id);
                    $success = rename('assets/iperformers/performer/gallery/' . $event->data['gallery'], 'assets/iperformers/performer/gallery/' . $id);
                }
            }
            $event->data['options'] = json_encode($options);
        }else{
            $event->data['options'] = json_encode($event->data['options']);
        }
        $this->performer->update($event->entity, $event->data);
    }

}