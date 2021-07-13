<?php

use Illuminate\Support\Facades\Route;

//? Users
$router->get('users', Users\ListUsers::class);
$router->post('users', Users\Create::class);
$router->delete('users/{id}', Users\Remove::class);
$router->post('users/authenticate', Users\Login::class);
