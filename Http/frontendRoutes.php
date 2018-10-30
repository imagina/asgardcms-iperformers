<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => 'lugares'], function (Router $router) {

    $router->get('/', [
        'as' => 'iperformers.performer.index',
        'uses' => 'PublicController@index',
    ]);
    $router->get('/{slugtype}', [
        'as' => 'iperformers.performer.type',
        'uses' => 'PublicController@type',
    ]);
    $router->get('{slugtype}/{slugperformer}', [
        'as' => 'iperformers.performer.show',
        'uses' => 'PublicController@show',
    ]);

});

