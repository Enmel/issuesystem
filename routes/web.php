<?php

use Illuminate\Support\Facades\Route;

$router->post('users/login', 'UserController@login');

//? Portfolio
Route::get('portfolio/suggest', Portfolio\Suggest::class);