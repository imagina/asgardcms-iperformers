<?php

namespace Modules\Iperformers\Repositories\Eloquent;

use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Iperformers\Entities\Status;
use Modules\Iperformers\Events\PerformerWasCreated;
use Modules\Iperformers\Repositories\Collection;
use Modules\Iperformers\Repositories\PerformerRepository;
use Illuminate\Database\Eloquent\Builder;


class EloquentPerformerRepository extends EloquentBaseRepository implements PerformerRepository
{
    public function wherebyFilter($page, $take, $filter, $include)
    {
        //Initialize Query
        $query = $this->model->query();

        /*== RELATIONSHIPS ==*/
        if (count($include)) {
            //Include relationships for default
            $includeDefault = ['types', 'cites', 'services',];
            $query->with(array_merge($includeDefault, $include));
        }

        /*== FILTER ==*/
        if ($filter) {
            //Filter by slug
            if (isset($filter->slug)) {
                $query->where('slug', $filter->slug);
            }


            //Filter excluding performers by ID
            if (isset($filter->excludeById) && is_array($filter->excludeById)) {
                $query->whereNotIn('id', $filter->excludeById);
            }

            //Get specific performers by ID
            if (isset($filter->includeById) && is_array($filter->includeById)) {
                $query->whereIn('id', $filter->includeById);
            }

            //Search filter
            if (isset($filter->search) && !empty($filter->search)) {
                //Get the words separately from the criterion
                $words = explode(' ', trim($filter->search));

                //Add condition of search to query
                $query->where(function ($query) use ($words) {
                    foreach ($words as $index => $word) {
                        $query->where('title', 'like', "%" . $word . "%")
                            ->orWhere('description', 'like', "%" . $word . "%");
                    }
                });
            }
            //Add order by city
            if (isset($filter->cities) && is_array($filter->cities)) {
                is_array($filter->cities) ? true : $filter->cities = [$filter->cities];
                $query->whereIn('city_id', $filter->cities);

            }
            //Add order for genre
            if (isset($filter->genres) && is_array($filter->genres)) {

                is_array($filter->genres) ? true : $filter->genres = [$filter->genres];
                $query->whereIn('genre_id', $filter->genres);
            }
            //Add order for type

            if (isset($filter->types) && is_array($filter->types)) {
                is_array($filter->types) ? true : $filter->types = [$filter->types];

                $query->whereHas('types', function ($q) use ($filter) {
                    $q->whereIn('type_id', $filter->types);
                });

            }


            //Add order for services

            if (isset($filter->services) && is_array($filter->services)) {
                is_array($filter->services) ? true : $filter->services = [$filter->services];
                $query->whereHas('services', function ($q) use ($filter) {
                    $q->whereIn('service_id', $filter->services);
                });
            }

            //Add order By
            $orderBy = isset($filter->orderBy) ? $filter->orderBy : 'created_at';
            $orderType = isset($filter->orderType) ? $filter->orderType : 'desc';
            $query->orderBy($orderBy, $orderType);
            $query->whereStatus(Status::ACTIVE);
        }

        /*=== REQUEST ===*/
        if ($page) {//Return request with pagination
            $take ? true : $take = 12; //If no specific take, query default take is 12
            return $query->paginate($take);
        } else {//Return request without pagination
            $take ? $query->take($take) : false; //Set parameter take(limit) if is requesting
            return $query->get();
        }
    }

    public function show($param, $include)
    {
        $isID = (int)$param >= 1 ? true : false;

        //Initialize Query
        $query = $this->model->query();

        if ($isID) {//if is by ID
            $query = $this->model->where('id', $param);
        } else {//if is by Slug
            $query = $this->model->where('slug', $param);
        }

        /*== RELATIONSHIPS ==*/
        if (count($include)) {
            //Include relationships for default
            $includeDefault = [];
            $query->with(array_merge($includeDefault, $include));
        }

        /*=== REQUEST ===*/
        return $query->first();
    }

    public function create($data)
    {
        // dd($data);
        $performer = $this->model->create($data);
        event(new PerformerWasCreated($performer, $data));
        $performer->types()->sync(array_get($data, 'types', []));
        $performer->services()->sync(array_get($data, 'services', []));
        $performer->related()->sync(array_get($data, 'related', []));
        return $this->find($performer->id);
    }

    public function update($model, $data)
    {//dd($data);
        $model->update($data);
        $model->types()->sync(array_get($data, 'types', []));
        $model->services()->sync(array_get($data, 'services', []));
        $model->related()->sync(array_get($data, 'related', []));
        return $model;
    }

    /**
     * @inheritdoc
     */
    public function findBySlug($slug)
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->whereHas('translations', function (Builder $q) use ($slug) {
                $q->where('slug', $slug);
            })->with('types', 'city', 'type','translations')->first();
        }

        return $this->model->with('types', 'city', 'type')->where('slug', $slug)->first();
    }

    public function whereType($id)
    {
         is_array($id) ? true : $id = [$id];
        $query = $this->model->with('city', 'type');
        $query->whereHas('types', function (Builder $q) use ($id) {
            $q->whereIn('type_id', $id);
        });
        $query->orderBy("created_at", "desc");
        $query->whereStatus(Status::ACTIVE);
        return $query->paginate(12);
    }


}
