<?php

namespace Modules\Iperformers\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Iperformers\Entities\Type;
use Modules\Iperformers\Entities\Genre;
use Laracasts\Presenter\PresentableTrait;
use Modules\Iperformers\Presenters\PerformerPresenter;
use Modules\Iperformers\Events\PerformerWasCreated;
use Modules\Core\Traits\NamespacedEntity;
use Modules\Ilocations\Entities\City;


class Performer extends Model
{
    use Translatable, PresentableTrait, NamespacedEntity;

    protected $table = 'iperformers__performers';
    public $translatedAttributes = ['title','description','slug','summary','metatitle','metadescription','metakeywords'];
    protected $fillable = ['title','description','slug','user_id','status','summary','options','type_id','created_at','metatitle','metadescription','metakeywords','genre_id','city_id','service_id'];
    protected $fakeColumns = ['options'];
    protected $presenter = PerformerPresenter::class;

    protected $casts = [
        'options' => 'array',
        'status'=>'int',
        'genre_id'=>'int'
    ];

    /*
     * ---------
     * RELATIONS
     * --------
     */

    public function user()
    {
        $driver = config('asgard.user.config.driver');
        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User");
    }
    public function type()
    {
        return $this->belongsTo(Type::class,'type_id');
    }
    public function Related()
    {
        return $this->belongsToMany(Performer::class, 'iperformers_related_performer','related_id');
    }
    public function types()
    {
        return $this->belongsToMany(Type::class, 'iperformers_performer_type');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'iperformers_performer_service');
    }
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }




    /*
     * -------------
     * IMAGE
     * -------------
     */

    public function getMainimageAttribute(){

        $image=$this->options->mainimage ?? 'modules/iperformers/img/default.jpg';
        $v=strftime('%u%w%g%k%M%S', strtotime($this->updated_at));
        // dd($v) ;
        return url($image.'?v='.$v);
        //return ($this->options->mainimage ?? 'modules/iperformers/img/performer/default.jpg').'?v='.format_date($this->updated_at,'%u%w%g%k%M%S');
    }
    public function getMediumimageAttribute(){

        return url(str_replace('.jpg','_mediumThumb.jpg',$this->options->mainimage ?? 'modules/iperformers/img/default.jpg'));
    }
    public function getThumbailsAttribute(){

        return url(str_replace('.jpg','_smallThumb.jpg',$this->options->mainimage?? 'modules/iperformers/img/default.jpg'));
    }
    public function getMetatitleAttribute(){

        $locale = \LaravelLocalization::setLocale() ?: \App::getLocale();
        return $this->translate($locale)->metatitle ?? $this->translate($locale)->title;

    }
    public function getMetadescriptionAttribute(){

        return $this->metadescription ?? substr(strip_tags($this->description),0,150);
    }
    public function getGalleryAttribute(){

        $images = \Storage::disk('publicmedia')->files('assets/iperformers/performer/gallery/' . $this->id);
        return $images;
    }


    public function getUrlAttribute() {

       // \URL::route(\LaravelLocalization::getCurrentLocale(

        return  \URL::route('iperformers.performer.show', [$this->type->slug,$this->slug]);
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
