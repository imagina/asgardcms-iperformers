<?php

namespace Modules\Iperformers\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Iperformers\Entities\Type;
use Modules\Iperformers\Entities\Performer;
use Modules\Iperformers\Http\Requests\CreatePerformerRequest;
use Modules\Iperformers\Http\Requests\UpdatePerformerRequest;
use Modules\Iperformers\Events\PerformerWasCreated;
use Modules\Iperformers\Repositories\PerformerRepository;
use Modules\Iperformers\Repositories\TypeRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Iperformers\Entities\Status;
use Modules\Iperformers\Repositories\GenreRepository;
use Modules\Iperformers\Repositories\ServiceRepository;
use Modules\User\Repositories\UserRepository;
use Modules\User\Transformers\UserProfileTransformer;
use Modules\Ilocations\Repositories\CityRepository;

class PerformerController extends AdminBaseController
{
    /**
     * @var PerformerRepository
     */
    private $performer;
    public $status;
    private $type;
    private $user;
    private $genre;
    private $service;
   private $city;


    public function __construct(PerformerRepository $performer, Status $status, TypeRepository $type, UserRepository $user, GenreRepository $genre, ServiceRepository $service, CityRepository $city)
    {
        parent::__construct();

        $this->performer = $performer;
        $this->status = $status;
        $this->type = $type;
        $this->user = $user;
        $this->genre = $genre;
        $this->service = $service;
       $this->city = $city;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $performers = $this->performer->paginate(20);

        return view('iperformers::admin.performers.index', compact('performers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $statuses = $this->status->lists();
        $types = $this->type->all();
        $users = $this->user->all();
        $genres = $this->genre->all();
        $services = $this->service->all();
        $related=$this->performer->all();
      $cities = $this->city->whereByCountry(48);
        return view('iperformers::admin.performers.create', compact('related','types', 'statuses', 'users', 'genres', 'services','cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreatePerformerRequest $request
     * @return Response
     */
    public function store(CreatePerformerRequest $request)
    {

        try {

             $this->performer->create($request->all());

            return redirect()->route('admin.iperformers.performer.index')
                ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('iperformers::performers.title.performers')]));
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()
                ->withError(trans('core::core.messages.resource error', ['name' => trans('iperformers::performers.title.performers')]))->withInput($request->all());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Performer $performer
     * @return Response
     */
    public function edit(Performer $performer)
    {//dd($performer->services);
        $statuses = $this->status->lists();
        $types = $this->type->all();
        $users = $this->user->all();
        $genres = $this->genre->all();
        $services = $this->service->all();
        $related=$this->performer->all();
       $cities = $this->city->all();
        return view('iperformers::admin.performers.edit', compact('related','performer', 'statuses', 'types', 'users', 'genres', 'services','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Performer $performer
     * @param  UpdatePerformerRequest $request
     * @return Response
     */
    public function update(Performer $performer, CreatePerformerRequest $request)
    {//dd($request);
        try {
            if (isset($request['options'])) {
                $options = (array)$request['options'];
            } else {
                $options = array();
            }

            isset($request->mainimage) ? $options["mainimage"] = saveImage($request['mainimage'], "assets/iperformers/performer/" . $performer->id . ".jpg") : false;

            $request['options'] = json_encode($options);
            $this->performer->update($performer, $request->all());

            return redirect()->route('admin.iperformers.performer.index')
                ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('iperformers::performers.title.performers')]));
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()
                ->withError(trans('core::core.messages.resource error', ['name' => trans('iperformers::performers.title.performers')]))->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Performer $performer
     * @return Response
     */
    public function destroy(Performer $performer)
    {
        try {
            $this->performer->destroy($performer);

            return redirect()->route('admin.iperformers.performer.index')
                ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('iperformers::performers.title.performers')]));

        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()
                ->withError(trans('core::core.messages.resource error', ['name' => trans('iperformers::performers.title.performers')]));
        }

    }

    public function galleryStore(Request $request)
    {
        try{
            $original_filename = $request->file('file')->getClientOriginalName();

            $idperformer = $request->input('idedit');
            $extension = $request->file('file')->getClientOriginalExtension();
            $allowedextensions = array('JPG', 'JPEG', 'PNG', 'GIF');

            if (!in_array(strtoupper($extension), $allowedextensions)) {
                return 0;
            }
            $disk = 'publicmedia';
            $image = \Image::make($request->file('file'));
            $name = str_slug(str_replace('.' . $extension, '', $original_filename), '-');


            $image->resize(config('asgard.performers.config.imagesize.width'), config('asgard.iperformers.config.imagesize.height'), function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            if (config('asgard.iperformers.config.watermark.activated')) {
                $image->insert(config('asgard.iperformers.config.watermark.url'), config('asgard.iperformers.config.watermark.position'), config('asgard.iperformers.config.watermark.x'), config('asgard.iperformers.config.watermark.y'));
            }
            $nameimag = $name . '.' . $extension;
            $destination_path = 'assets/iperformers/performer/gallery/' . $idperformer . '/' . $nameimag;

            \Storage::disk($disk)->put($destination_path, $image->stream($extension, '100'));

            return array('direccion' => $destination_path);
        }
        catch (\Exception $e){
            return $e->getMessage();
        }

    }

    public function galleryDelete(Request $request)
    {
        $disk = "publicmedia";
        $dirdata = $request->input('dirdata');
        \Storage::disk($disk)->delete($dirdata);
        return array('success' => true);
    }
    
}
