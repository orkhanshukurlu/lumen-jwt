<?php

$router->post('register', 'AuthController@register');
$router->post('login',    'AuthController@login');

$router->group(['middleware' => 'auth'], function ($router)
{
    $router->post('logout',         'AuthController@logout');
    $router->get('profile',         'AuthController@profile');
    $router->get('users',           'UserController@index');
    $router->post('users',          'UserController@store');
    $router->get('users/{user}',    'UserController@show');
    $router->put('users/{user}',    'UserController@update');
    $router->delete('users/{user}', 'UserController@destroy');
});
