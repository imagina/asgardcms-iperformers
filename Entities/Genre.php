<?php

namespace Modules\Iperformers\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Iperformers\Events\TypeWasCreated;
use Modules\Core\Traits\NamespacedEntity;
use Laracasts\Presenter\PresentableTrait;


class Genre extends Model
{
    use Translatable,PresentableTrait, NamespacedEntity;

    protected $table = 'iperformers__genres';
    public $translatedAttributes = ['title', 'description'];
    protected $fillable = ['title', 'description', 'options'];
    protected $fakeColumns = ['options'];
   // protected $presenter = TypePresenter::class;


    protected $casts = [
        'options' => 'array'
    ];

    /*
     * ---------
     * RELATIONS
     * ---------
     */

    public function performers()
    {
        return $this->hasMany(Performer::class);
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


}