<?php

use Illuminate\Support\Facades\Route;

$router->post('users/login', 'UserController@login');

//? Packages
$router->get('packages/today', 'PackageController@toDeliverToday');
$router->get('packages/rejected', 'PackageController@rejected');
$router->get('packages/charged', 'PackageController@chargedToday');
$router->patch('packages/organize', 'PackageController@personalOrder');
$router->get('packages/{id}', 'PackageController@findByID');
$router->patch('packages/{id}', 'PackageController@editPackage');

//? WithdrawalSchedule
Route::get('withdrawalschedule', WithdrawalSchedule\Show::class);
Route::patch('withdrawalschedule/{withdrawalSchedule}', WithdrawalSchedule\SetHour::class);