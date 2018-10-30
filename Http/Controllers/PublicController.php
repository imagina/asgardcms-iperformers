<?php

namespace Modules\Iperformers\Http\Controllers;

use Log;
use Mockery\CountValidator\Exception;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Iperformers\Repositories\TypeRepository;
use Modules\Iperformers\Repositories\PerformerRepository;
use Modules\Iperformers\Repositories\ServiceRepository;
use Modules\Iperformers\Repositories\GenreRepository;
use Illuminate\Http\Request;
use Route;

class PublicController extends BasePublicController
{

    public $performer;
    public $type;
    public $service;
    public $genre;

    public function __construct(PerformerRepository $performer, TypeRepository $type, ServiceRepository $service, GenreRepository $genre)
    {
        parent::__construct();
        $this->performer = $performer;
        $this->type = $type;
        $this->service = $service;
        $this->genre = $genre;
    }

    public function index(Request $request)
    {

        $oldCat=null;
        $oldServ=null;
        $oldGenre=null;
        if ((isset($request->types) && !empty($request->types))||(isset($request->services) && !empty($request->services))||(isset($request->genres) && !empty($request->genres)) ) {
            $filter=['types'=>$request->types,"services"=>$request->services, "genres"=>$request->genres];

            $performers = $this->performer->wherebyFilter($request->page,$take=12, json_decode(json_encode($filter)), $include=null);
            $oldCat=$request->types;
            $oldServ=$request->services;
            $oldGenre=$request->genres;
        } else {
            $performers = $this->performer->paginate(12);
        }

        $services = $this->service->all();
        $genres = $this->genre->all();
        $types = $this->type->all();
        $tpl = 'iperformers::frontend.index';
        $ttpl = 'iperformers.frontend.index';

        if (view()->exists($ttpl)) $tpl = $ttpl;

        Return view($tpl, compact('performers', 'types', 'genres', 'services','oldCat', 'oldServ','oldGenre'));

    }

    public function type($slugType)
    {

        $type = $this->type->findBySlug($slugType);
        $performers = $this->performer->whereType($type->id);
        $services = $this->service->all();
        $genres = $this->genre->all();
        $types = $this->type->all();
        $tpl = 'iperformers::frontend.index';
        $ttpl = 'iperformers.frontend.index';

        if (view()->exists($ttpl)) $tpl = $ttpl;

        Return view($tpl, compact('performers', 'type', 'genres', 'services','types'));

    }

    public function show($slugType,$slugPerformer)
    {

        $type = $this->type->findBySlug($slugType);
      // dd($type);
        $performer = $this->performer->findBySlug($slugPerformer);
       if($performer->type->id ==$type->id){
           $services = $this->service->all();
           $genres = $this->genre->all();
           $tpl = 'iperformers::frontend.show';
           $ttpl = 'iperformers.frontend.show';

           if (view()->exists($ttpl)) $tpl = $ttpl;

           Return view($tpl, compact('performers', 'type', 'genres', 'services'));
       }

       return abort(404);


    }
}