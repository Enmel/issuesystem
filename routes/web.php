<?php

use Illuminate\Support\Facades\Route;

//? Users
Route::get('users', Users\ListUsers::class);
Route::post('users', Users\Create::class);
Route::put('users/{id}', Users\Update::class);
Route::delete('users/{id}', Users\Remove::class);
Route::post('users/authenticate', Users\Login::class);

//? Groups
Route::get('groups', Groups\ListGroups::class);
Route::post('groups', Groups\Create::class);
Route::put('groups/{id}', Groups\Update::class);
Route::delete('groups/{id}', Groups\Remove::class);

//? Files
Route::post('files', Files\Upload::class);
