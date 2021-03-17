<?php

use Illuminate\Support\Facades\Route;

$router->post('users/login', 'UserController@login');

//? Packages
$router->get('packages', 'PackageController@listPackages');
$router->get('packages/recolector', 'PackageController@listPackagesRecolector');
$router->get('packages/today', 'PackageController@toDeliverToday');
$router->get('packages/rejected', 'PackageController@rejected');
$router->get('packages/charged', 'PackageController@chargedToday');
$router->patch('packages/organize', 'PackageController@personalOrder');
$router->get('packages/{id}', 'PackageController@findByID');
$router->patch('packages/{id}', 'PackageController@editPackage');

//? WithdrawalSchedule
Route::get('withdrawalschedule', WithdrawalSchedule\Show::class);
Route::patch('withdrawalschedule/{withdrawalSchedule}', WithdrawalSchedule\SetHour::class);

//? Collector
Route::get('collector', Collector\ListPendingPackages::class);

//? Depositary
Route::get('depositary', Depositary\ListPendingPackages::class);

//? PanelCollector
Route::get('panelcollector', PanelCollector\ListPendingPackages::class);