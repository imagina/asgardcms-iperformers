<?php

namespace Modules\Iperformers\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Iperformers\Entities\Type;
use Modules\Iperformers\Http\Requests\CreateTypeRequest;
use Modules\Iperformers\Http\Requests\UpdateTypeRequest;
use Modules\Iperformers\Events\TypeWasCreated;
use Modules\Iperformers\Repositories\TypeRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Transformers\UserProfileTransformer;
use Modules\Iperformers\Entities\Status;


class TypeController extends AdminBaseController
{
    /**
     * @var TypeRepository
     */
    private $type;
    public $status;
   // public $file;

    public function __construct(TypeRepository $type, Status $status)
    {
        parent::__construct();

        $this->type = $type;
        $this->status=$status;
       // $this->file = $file;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $types = $this->type->paginate(20);

        return view('iperformers::admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $statuses = $this->status->lists();
        $types = $this->type->paginate(20);
        return view('iperformers::admin.types.create',compact('types','statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateTypeRequest $request
     * @return Response
     */
    public function store(CreateTypeRequest $request)
    {
      // dd($request);
        try{
            $this->type->create($request->all());


            return redirect()->route('admin.iperformers.type.index')
                ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('iperformers::types.title.types')]));
        }
        catch (\Exception $e){
            \Log::error($e);
            return redirect()->back()
                ->withError(trans('core::core.messages.resource error', ['name' => trans('iperformers::types.title.types')]))->withInput($request->all());

        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Type $type
     * @return Response
     */
    public function edit(Type $type)
    {
    //dd($type->mainimage);
        $statuses = $this->status->lists();
        $types = $this->type->paginate(20);
      //  $thumbnail = $this->file->findFileByGenreForEntity('thumbnail', $type);
        return view('iperformers::admin.types.edit', compact('type', 'statuses', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Type $type
     * @param  UpdateTypeRequest $request
     * @return Response
     */
    public function update(Type $type, CreateTypeRequest $request)
    {
        try{
            if(isset($request['options'])){
                $options=(array)$request['options'];
            }else{$options = array();}

            isset($request->mainimage) ? $options["mainimage"] = saveImage($request['mainimage'], "assets/iperformers/type/" . $type->id . ".jpg") : false;
            $request['options'] = json_encode($options);
            $this->type->update($type, $request->all());
            return redirect()->route('admin.iperformers.type.index')
                ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('iperformers::types.title.types')]));

        }catch (\Exception $e){
            \Log::error($e);
            return redirect()->back()
                ->withError(trans('core::core.messages.resource error', ['name' => trans('iperformers::types.title.types')]))->withInput($request->all());

    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Type $type
     * @return Response
     */
    public function destroy(Type $type)
    {
        try{
            $this->type->destroy($type);

            return redirect()->route('admin.iperformers.type.index')
                ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('iperformers::types.title.types')]));

        }catch (\Exception $e){

            \Log::error($e);
            return redirect()->back()
                ->withError(trans('core::core.messages.resource error', ['name' => trans('iperformers::types.title.types')]));
        }

    }
}
