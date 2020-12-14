<?php


$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('users/login', 'UserController@login');