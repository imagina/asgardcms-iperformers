<?php

namespace Modules\Iperformers\Entities;

use Dimsav\Translatable\Translatable;
use http\Url;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Modules\Iperformers\Presenters\TypePresenter;
use Modules\Iperformers\Events\TypeWasCreated;
use Modules\Core\Traits\NamespacedEntity;
use Laracasts\Presenter\PresentableTrait;


class Type extends Model
{
    use Translatable, PresentableTrait, NamespacedEntity;
    //use Sluggable;

    protected $table = 'iperformers__types';
    public $translatedAttributes = ['title', 'description', 'slug','metatitle','metadescription','metakeywords'];
    protected $fillable = ['title', 'description', 'slug', 'parent_id', 'options','status','metatitle','metadescription','metakeywords'];
    protected $fakeColumns = ['options'];
    protected $presenter = TypePresenter::class;


    protected $casts = [
        'options' => 'array'
    ];

    /*
     * ---------
     * RELATIONS
     * ---------
     */
    public function parent()
    {
        return $this->belongsTo('Modules\Iperformers\Entities\Type', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('Modules\Iperformers\Entities\Type', 'parent_id');
    }

    public function performers()
    {
        return $this->belongsToMany(Performer::class, 'iperformers_performer_type');
    }

    protected function setSlugAttribute($value)
    {

        if (!empty($value)) {
            $this->attributes['slug'] = str_slug($value, '-');
        } else {
            $this->attributes['slug'] = str_slug($this->attributes['title'], '-');
        }
    }
    //generar url automatica
    /* public function sluggable()
     {
         return [
             'slug' => [
                 'source' => 'title'
             ]
         ];
     }*/
    /*
     * -------------
     * IMAGE
     * -------------
     */

    public function getMainimageAttribute()
    {
        $image=$this->options->mainimage ?? 'modules/iperformers/img/default.jpg';
        $v=strftime('%u%w%g%k%M%S', strtotime($this->updated_at));
      // dd($v) ;
        return url($image.'?v='.$v);

    }

    public function getMediumimageAttribute()
    {

        return str_reperformer('.jpg', '_mediumThumb.jpg', $this->options->mainimage ?? 'modules/iperformers/img/default.jpg');
    }

    public function getThumbailsAttribute()
    {

        return str_reperformer('.jpg', '_smallThumb.jpg', $this->options->mainimage ?? 'modules/iperformers/img/default.jpg');
    }


    /**
     * @return mixed
     */


    public function getUrlAttribute()
    {

        return url($this->slug);

    }

    public function getOptionsAttribute($value)
    {

        return json_decode(json_decode($value));

    }

    /*
   |--------------------------------------------------------------------------
   | SCOPES
   |--------------------------------------------------------------------------
   */
    public function scopeFirstLevelItems($query)
    {
        return $query->where('depth', '1')
            ->orWhere('depth', null)
            ->orderBy('lft', 'ASC');
    }

    /**
     * Check if the post is in draft
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query)
    {
        return $query->whereStatus(Status::ACTIVE);
    }

    /**
     * Check if the post is pending review
     * @param Builder $query
     * @return Builder
     */
    public function scopeInactive(Builder $query)
    {
        return $query->whereStatus(Status::INACTIVE);
    }

}
