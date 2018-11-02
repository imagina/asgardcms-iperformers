<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => 'iperformers'], function (Router $router) {

    $router->group(['prefix' => 'performers'], function (Router $router) {
        $router->bind('performer', function ($id) {
            return app('Modules\Iperformers\Repositories\PerformerRepository')->find($id);
        });
        $router->get('/', [
            'as' => 'admin.iperformers.performer.index',
            'uses' => 'PerformerController@index',
            'middleware' => 'can:iperformers.performers.index'
        ]);
        $router->get('create', [
           // dd('hgh'),
            'as' => 'admin.iperformers.performer.create',
            'uses' => 'PerformerController@create',
            'middleware' => 'can:iperformers.performers.create'
        ]);
        $router->post('/', [
            'as' => 'admin.iperformers.performer.store',
            'uses' => 'PerformerController@store',
            'middleware' => 'can:iperformers.performers.create'
        ]);
        $router->get('{performer}/edit', [
            'as' => 'admin.iperformers.performer.edit',
            'uses' => 'PerformerController@edit',
            'middleware' => 'can:iperformers.performers.edit'
        ]);
        $router->put('{performer}', [
            'as' => 'admin.iperformers.performer.update',
            'uses' => 'PerformerController@update',
            'middleware' => 'can:iperformers.performers.edit'
        ]);
        $router->delete('{performer}', [
            'as' => 'admin.iperformers.performer.destroy',
            'uses' => 'PerformerController@destroy',
            'middleware' => 'can:iperformers.performers.destroy'
        ]);
        $router->post('gallery', [
            'as' => 'iperformers.performers.gallery.store',
            'uses' => 'PerformerController@galleryStore',
            //'middleware' => ['api.token','token-can:iperformers.performers.create']
        ]);
        $router->post('gallery/delete', [
            'as' => 'iperformers.performers.gallery.delete',
            'uses' => 'PerformerController@galleryDelete',
           // 'middleware' => ['api.token','token-can:iperformers.performers.create']
        ]);
    });

    $router->group(['prefix' => 'types'], function (Router $router) {
        $router->bind('type', function ($id) {
            return app('Modules\Iperformers\Repositories\TypeRepository')->find($id);
        });
        $router->get('/', [
            'as' => 'admin.iperformers.type.index',
            'uses' => 'TypeController@index',
            'middleware' => 'can:iperformers.types.index'
        ]);
        $router->get('create', [
            'as' => 'admin.iperformers.type.create',
            'uses' => 'TypeController@create',
            'middleware' => 'can:iperformers.types.create'
        ]);
        $router->post('', [
            'as' => 'admin.iperformers.type.store',
            'uses' => 'TypeController@store',
            'middleware' => 'can:iperformers.types.create'
        ]);
        $router->get('{type}/edit', [
            'as' => 'admin.iperformers.type.edit',
            'uses' => 'TypeController@edit',
            'middleware' => 'can:iperformers.types.edit'
        ]);
        $router->put('{type}', [
            'as' => 'admin.iperformers.type.update',
            'uses' => 'TypeController@update',
            'middleware' => 'can:iperformers.types.edit'
        ]);
        $router->delete('{type}', [
            'as' => 'admin.iperformers.type.destroy',
            'uses' => 'TypeController@destroy',
            'middleware' => 'can:iperformers.types.destroy'
        ]);
    });

    $router->group(['prefix' => '/services'], function (Router $router) {

        $router->bind('service', function ($id) {
            return app('Modules\Iperformers\Repositories\ServiceRepository')->find($id);
        });
        $router->get('/', [
            'as' => 'admin.iperformers.service.index',
            'uses' => 'ServiceController@index',
            'middleware' => 'can:iperformers.services.index'
        ]);
        $router->get('create', [
            'as' => 'admin.iperformers.service.create',
            'uses' => 'ServiceController@create',
            'middleware' => 'can:iperformers.services.create'
        ]);
        $router->post('/', [
            'as' => 'admin.iperformers.service.store',
            'uses' => 'ServiceController@store',
            'middleware' => 'can:iperformers.services.create'
        ]);
        $router->get('{service}/edit', [
            'as' => 'admin.iperformers.service.edit',
            'uses' => 'ServiceController@edit',
            'middleware' => 'can:iperformers.services.edit'
        ]);
        $router->put('{service}', [
            'as' => 'admin.iperformers.service.update',
            'uses' => 'ServiceController@update',
            'middleware' => 'can:iperformers.services.edit'
        ]);
        $router->delete('{service}', [
            'as' => 'admin.iperformers.service.destroy',
            'uses' => 'ServiceController@destroy',
            'middleware' => 'can:iperformers.services.destroy'
        ]);

    });
    $router->group(['prefix' => '/genres'], function (Router $router) {

        $router->bind('genre', function ($id) {
            return app('Modules\Iperformers\Repositories\GenreRepository')->find($id);
        });
        $router->get('/', [
            'as' => 'admin.iperformers.genre.index',
            'uses' => 'GenreController@index',
            'middleware' => 'can:iperformers.genres.index'
        ]);
        $router->get('create', [
            'as' => 'admin.iperformers.genre.create',
            'uses' => 'GenreController@create',
            'middleware' => 'can:iperformers.genres.create'
        ]);
        $router->post('/', [
            'as' => 'admin.iperformers.genre.store',
            'uses' => 'GenreController@store',
            'middleware' => 'can:iperformers.genres.create'
        ]);
        $router->get('{genre}/edit', [
            'as' => 'admin.iperformers.genre.edit',
            'uses' => 'GenreController@edit',
            'middleware' => 'can:iperformers.genres.edit'
        ]);
        $router->put('{genre}', [
            'as' => 'admin.iperformers.genre.update',
            'uses' => 'GenreController@update',
            'middleware' => 'can:iperformers.genres.edit'
        ]);
        $router->delete('{genre}', [
            'as' => 'admin.iperformers.genre.destroy',
            'uses' => 'GenreController@destroy',
            'middleware' => 'can:iperformers.genres.destroy'
        ]);
// append


    });
});

