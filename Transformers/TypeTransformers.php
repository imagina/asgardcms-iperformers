<?php


namespace Modules\Iperformers\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\User\Transformers\UserProfileTransformer;
use Modules\Iperformers\Events\TypeWasCreated;


class TypeTransformers extends Resource
{

    public function toArray($request)
    {

      //  $dateformat= config('asgard.iperformers.config.dateformat');
        $options=$this->options;
        unset($options->mainimage,$options->metatitle,$options->metadescription);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'status'=>$this->status,
            'mainimage' => $this->mainimage,
            'metatitle'=>$this->metatitle??$this->title,
            'metadescription'=>$this->metadescription,
            'metakeywords'=>$this->metakeywords,
            'options' => $options,
            'created_at' => ($this->created_at),
            'updated_at' => ($this->updated_at)
        ];

        if (in_array('type',$includes)) {

            $data['type']= TypeTransformers::collection($this->types);
        }
        return $data;


    }


}