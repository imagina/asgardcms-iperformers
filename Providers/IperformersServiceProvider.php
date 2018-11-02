<?php

namespace Modules\Iperformers\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Iperformers\Events\Handlers\RegisterIperformersSidebar;

class IperformersServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterIperformersSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('performers', array_dot(trans('iperformers::performers')));
            $event->load('types', array_dot(trans('iperformers::types')));
            $event->load('services', array_dot(trans('iperformers::services')));
            $event->load('genres', array_dot(trans('iperformers::genres')));
            // append translations




        });
    }

    public function boot()
    {
        $this->publishConfig('iperformers', 'permissions');
        $this->publishConfig('iperformers', 'config');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Iperformers\Repositories\PerformerRepository',
            function () {
                $repository = new \Modules\Iperformers\Repositories\Eloquent\EloquentPerformerRepository(new \Modules\Iperformers\Entities\Performer());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iperformers\Repositories\Cache\CachePerformerDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iperformers\Repositories\TypeRepository',
            function () {
                $repository = new \Modules\Iperformers\Repositories\Eloquent\EloquentTypeRepository(new \Modules\Iperformers\Entities\Type());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iperformers\Repositories\Cache\CacheTypeDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iperformers\Repositories\ServiceRepository',
            function () {
                $repository = new \Modules\Iperformers\Repositories\Eloquent\EloquentServiceRepository(new \Modules\Iperformers\Entities\Service());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iperformers\Repositories\Cache\CacheServiceDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iperformers\Repositories\GenreRepository',
            function () {
                $repository = new \Modules\Iperformers\Repositories\Eloquent\EloquentGenreRepository(new \Modules\Iperformers\Entities\Genre());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iperformers\Repositories\Cache\CacheGenreDecorator($repository);
            }
        );
// add bindings




    }
}
