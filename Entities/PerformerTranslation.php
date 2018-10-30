<?php

namespace Modules\Iperformers\Entities;

use Illuminate\Database\Eloquent\Model;

class PerformerTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title','summary','description','slug','metatitle','metadescription','metakeywords'];
    protected $table = 'iperformers__performer_translations';

    protected function setSummaryAttribute($value){

        if(!empty($value)){
            $this->attributes['summary'] = $value;
        } else {
            $this->attributes['summary'] = substr(strip_tags($this->attributes['description']),0,150);
        }

    }

    protected function setMetatitleAttribute($value){

        if(!empty($value)){
            $this->attributes['metatitle'] = $value;
        } else {
            $this->attributes['metatitle'] = $this->attributes['title'];
        }

    }

    protected function setMetadescriptionAttribute($value){

        if(!empty($value)){
            $this->attributes['metadescription'] = $value;
        } else {
            $this->attributes['metadescription'] = substr(strip_tags($this->attributes['description']),0,150);
        }

    }
}
