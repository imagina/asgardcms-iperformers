<?php

namespace Modules\Iperformers\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Iperformers\Entities\Genre;
use Modules\Iperformers\Http\Requests\CreateGenreRequest;
use Modules\Iperformers\Http\Requests\UpdateGenreRequest;
use Modules\Iperformers\Events\GenreWasCreated;
use Modules\Iperformers\Repositories\GenreRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class GenreController extends AdminBaseController
{
    /**
     * @var GenreRepository
     */
    private $genre;

    public function __construct(GenreRepository $genre)
    {
        parent::__construct();

        $this->genre = $genre;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $genres = $this->genre->paginate(20);

        return view('iperformers::admin.genres.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $genres = $this->genre->paginate(20);
        return view('iperformers::admin.genres.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateGenreRequest $request
     * @return Response
     */
    public function store(CreateGenreRequest $request)
    {//dd($request);

        try {
            $this->genre->create($request->all());

            return redirect()->route('admin.iperformers.genre.index')
                ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('iperformers::genres.title.genres')]));
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()
                ->withError(trans('core::core.messages.resource error', ['name' => trans('iperformers::genres.title.genres')]))->withInput($request->all());

        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Genre $genre
     * @return Response
     */
    public function edit(Genre $genre)
    {//dd($genre);
        $genres = $this->genre->paginate(20);
        return view('iperformers::admin.genres.edit', compact('genre','genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Genre $genre
     * @param  UpdateGenreRequest $request
     * @return Response
     */
    public function update(Genre $genre, UpdateGenreRequest $request)
    {//dd($genre);
        try {
            if(isset($request['options'])){
                $options=(array)$request['options'];
            }else{$options = array();}
            $request['options'] = json_encode($options);
            $this->genre->update($genre, $request->all());

            return redirect()->route('admin.iperformers.genre.index')
                ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('iperformers::genres.title.genres')]));
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()
                ->withError(trans('core::core.messages.resource error', ['name' => trans('iperformers::genres.title.genres')]))->withInput($request->all());

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Genre $genre
     * @return Response
     */
    public function destroy(Genre $genre)
    {
        try {
            $this->genre->destroy($genre);

            return redirect()->route('admin.iperformers.genre.index')
                ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('iperformers::genres.title.genres')]));
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()
                ->withError(trans('core::core.messages.resource error', ['name' => trans('iperformers::genres.title.genres')]));

        }
    }
}
