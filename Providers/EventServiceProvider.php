<?php

namespace Modules\Iperformers\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Iperformers\Events\TypeWasCreated;
use Modules\Iperformers\Events\TypeWasDeleted;
use Modules\Iperformers\Events\ServiceWasCreated;
use Modules\Iperformers\Events\ServiceWasDeleted;
use Modules\Iperformers\Events\Handlers\DeleteTypeImage;
use Modules\Iperformers\Events\Handlers\SaveTypeImage;
use Modules\Iperformers\Events\Handlers\SaveServiceImage;
use Modules\Iperformers\Events\PerformerWasCreated;
use Modules\Iperformers\Events\Handlers\SavePerformerImage;


class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        TypeWasCreated::class => [
           SaveTypeImage::class,
        ],
        TypeWasDeleted::class=>[
            DeleteTypeImage::class,
        ],
        PerformerWasCreated::class => [
            SavePerformerImage::class,
        ],
        PerformerWasDeleted::class => [
            SavePerformerImage::class,
        ],
        ServiceWasCreated::class => [
            SaveServiceImage::class,
        ],
        ServiceWasDeleted::class => [
            SaveServiceImage::class,
        ],


    ];
}