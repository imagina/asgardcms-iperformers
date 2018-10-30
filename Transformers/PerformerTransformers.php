<?php
/**
 * Created by PhpStorm.
 * User: imagina
 * Date: 10/10/2018
 * Time: 5:26 PM
 */

namespace Modules\Iperformers\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\User\Transformers\UserProfileTransformer;


class PerformerTransformers extends Resource
{

    /**
     * @param $request
     * @return array
     */
    public function toArray($request)
    {
        //  $dateformat= config('asgard.iperformers.config.dateformat');
        $options = $this->options;
        unset($options->mainimage, $options->metatitle, $options->metadescription);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'status'=>$this->status,
            'description' => $this->description,
            'type_id' => $this->type_id,
            'types' => $this->types,
            'service_id' => $this->service_id,
            'services' => $this->services,
            'genre_id' => $this->genre_id,
            'mainimage' => $this->mainimage,
            'mediumimage' => $this->mediumimage,
            'thumbails' => $this->thumbails,
            'metatitle' => $this->metatitle ?? $this->title,
            'metadescription' => $this->metadescription ?? $this->summary,
            'metakeywords' => $this->metakeywords,
            'options' => $options,
            'created_at' => ($this->created_at),
            'updated_at' => ($this->updated_at)
        ];
    }


}