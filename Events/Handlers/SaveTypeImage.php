<?php
/**
 * Created by PhpStorm.
 * User: imagina
 * Date: 2/10/2018
 * Time: 6:02 PM
 */

namespace Modules\Iperformers\Events\Handlers;

use Modules\Iperformers\Events\TypeWasCreated;
use Modules\Iperformers\Repositories\TypeRepository;


class SaveTypeImage
{
    private $type;

    public function __construct(TypeRepository $type)
    {
        $this->type = $type;
    }

    public function handle(TypeWasCreated $event)
    {
        try {
            $id = $event->entity->id;
            if (!empty($event->data['mainimage'])) {
                $mainimage = saveImage($event->data['mainimage'], "assets/iperformers/type/" . $id . ".jpg");
                if (isset($event->data['options'])) {
                    $options = (array)$event->data['options'];
                } else {
                    $options = array();
                }
                $options["mainimage"] = $mainimage;
                $event->data['options'] = json_encode($options);
                // dd($event);
            } else {
                $event->data['options'] = json_encode($event->data['options']);
            }
            $this->type->update($event->entity, $event->data);
        } catch (\Exception $e) {
            \Log::error($e);

        }
    }


}