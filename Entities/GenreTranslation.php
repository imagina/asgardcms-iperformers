<?php

namespace Modules\Iperformers\Entities;

use Illuminate\Database\Eloquent\Model;

class GenreTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title','description'];
    protected $table = 'iperformers__genre_translations';
}
