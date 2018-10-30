<?php

namespace Modules\Iperformers\Presenters;

use Laracasts\Presenter\Presenter;


class GenrePresenter extends Presenter
{
    private $genre;

    public function __construct($entity)
    {
        parent::__construct($entity);
        $this->genre = app('Modules\Iperformers\Repositories\GenreRepository');

    }

}