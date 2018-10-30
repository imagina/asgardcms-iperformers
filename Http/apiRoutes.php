<?php

use Illuminate\Routing\Router;

$router->group(['prefix'=>'iperformers'],function (Router $router){

    $router->group(['prefix' => 'performers'], function (Router $router) {

        /*Update 2018-10-16. Routes Index and Show for posts*/
        $router->get('/', [
            'as' => 'iperformers.api.performers.index',
            'uses' => 'PerformerController@index',
        ]);
        $router->get('/{param}', [
            'as' => 'iperformers.api.performers.show',
            'uses' => 'PerformerController@show',
        ]);

        $router->bind('aiperformersperformer', function ($id) {
            return app(\Modules\Iperformers\Repositories\PerformerRepository::class)->find($id);
        });
        $router->get('/', [
            'as' => 'iperformers.api.performers',
            'uses' => 'PerformerController@performers',
        ]);
        $router->get('{aiperformersperformer}', [
            'as' => 'iperformers.api.performer',
            'uses' => 'PerformerController@performer',
        ]);
        $router->post('/', [
            'as' => 'iperformers.api.performers.store',
            'uses' => 'PerformerController@store',
            'middleware' => ['api.token','token-can:iperformers.performers.create']
        ]);
        $router->post('gallery', [
            'as' => 'iperformers.api.performers.gallery.store',
            'uses' => 'PerformerController@galleryStore',
            'middleware' => ['api.token','token-can:iperformers.performers.create']
        ]);
        $router->post('gallery/delete', [
            'as' => 'iperformers.api.performers.gallery.delete',
            'uses' => 'PerformerController@galleryDelete',
            'middleware' => ['api.token','token-can:iperformers.performers.create']
        ]);
        $router->put('{aiperformersperformer}', [
            'as' => 'iperformers.api.performers.update',
            'uses' => 'PerformerController@update',
            'middleware' =>['api.token','token-can:iperformers.performers.edit']
        ]);
        $router->delete('{aiperformersperformer}', [
            'as' => 'iperformers.api.performers.delete',
            'uses' => 'PerformerController@delete',
            'middleware' => ['api.token','token-can:iperformers.performers.destroy']
        ]);
    });
    $router->group(['prefix' => 'types'], function (Router $router) {

        $router->bind('aiperformerscat', function ($id) {

           return app(\Modules\Iperformers\Repositories\TypeRepository::class)->find($id);
        });
        $router->get('/', [
            'as' => 'iblog.api.types.index',
            'uses' => 'TypeController@index',
        ]);
        $router->get('/{slug}', [
            'as' => 'iblog.api.types.show',
            'uses' => 'TypeController@show',
        ]);

        $router->get('/', [
            'as' => 'iperformers.api.types',
            'uses' => 'TypeController@types',
        ]);
        $router->get('{aiperformerscat}', [
            'as' => 'iperformers.api.type',
            'uses' => 'TypeController@type',
        ]);
        $router->get('{aiperformerscat}/performers', [
            'as' => 'iperformers.api.types.performers',
            'uses' => 'TypeController@performers',
        ]);
        $router->post('/', [
            'as' => 'iperformers.api.types.store',
            'uses' => 'TypeController@store',
            'middleware' => ['api.token','token-can:iperformers.types.create']
        ]);
        $router->put('{aiperformerscat}', [
            'as' => 'iperformers.api.types.update',
            'uses' => 'TypeController@update',
            'middleware' =>['api.token','token-can:iperformers.types.edit']
        ]);
        $router->delete('{aiperformerscat}', [
            'as' => 'iperformers.api.types.delete',
            'uses' => 'TypeController@delete',
            'middleware' => ['api.token','token-can:iperformers.types.destroy']
        ]);
    });

    $router->group(['prefix' => 'services'], function (Router $router) {

        $router->bind('aiperformersserv', function ($id) {

            return app(\Modules\Iperformers\Repositories\ServiceRepository::class)->find($id);
        });

        $router->get('/', [
            'as' => 'iblog.api.services.index',
            'uses' => 'ServiceController@index',
        ]);
        $router->get('/{slug}', [
            'as' => 'iblog.api.services.show',
            'uses' => 'ServiceController@show',
        ]);

        $router->get('/', [
            'as' => 'iperformers.api.services',
            'uses' => 'ServiceController@services',
        ]);
        $router->get('{aiperformersserv}', [
            'as' => 'iperformers.api.type',
            'uses' => 'ServiceController@type',
        ]);
        $router->get('{aiperformersserv}/performers', [
            'as' => 'iperformers.api.services.performers',
            'uses' => 'ServiceController@performers',
        ]);
        $router->post('/', [
            'as' => 'iperformers.api.services.store',
            'uses' => 'ServiceController@store',
            'middleware' => ['api.token','token-can:iperformers.services.create']
        ]);
        $router->put('{aiperformersserv}', [
            'as' => 'iperformers.api.services.update',
            'uses' => 'ServiceController@update',
            'middleware' =>['api.token','token-can:iperformers.services.edit']
        ]);
        $router->delete('{aiperformersserv}', [
            'as' => 'iperformers.api.services.delete',
            'uses' => 'ServiceController@delete',
            'middleware' => ['api.token','token-can:iperformers.services.destroy']
        ]);
    });
    $router->group(['prefix' => 'genres'], function (Router $router) {

        $router->bind('aiperformersgenre', function ($id) {

            return app(\Modules\Iperformers\Repositories\GenreRepository::class)->find($id);
        });

        $router->get('/', [
            'as' => 'iblog.api.genres.index',
            'uses' => 'GenreController@index',
        ]);
        $router->get('/{slug}', [
            'as' => 'iblog.api.genres.show',
            'uses' => 'GenreController@show',
        ]);

        $router->get('/', [
            'as' => 'iperformers.api.genres',
            'uses' => 'GenreController@genres',
        ]);
        $router->get('{aiperformersgenre}', [
            'as' => 'iperformers.api.type',
            'uses' => 'GenreController@genre',
        ]);
        $router->get('{aiperformersgenre}/performers', [
            'as' => 'iperformers.api.genres.performers',
            'uses' => 'GenreController@performers',
        ]);
        $router->post('/', [
            'as' => 'iperformers.api.genres.store',
            'uses' => 'GenreController@store',
            'middleware' => ['api.token','token-can:iperformers.genres.create']
        ]);
        $router->put('{aiperformersgenre}', [
            'as' => 'iperformers.api.genres.update',
            'uses' => 'GenreController@update',
            'middleware' =>['api.token','token-can:iperformers.genres.edit']
        ]);
        $router->delete('{aiperformersgenre}', [
            'as' => 'iperformers.api.genres.delete',
            'uses' => 'GenreController@delete',
            'middleware' => ['api.token','token-can:iperformers.genres.destroy']
        ]);
    });
    

});
