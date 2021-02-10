<?php

$router->post('users/login', 'UserController@login');

$router->get('packages/today', 'PackageController@toDeliverToday');
$router->get('packages/rejected', 'PackageController@rejected');
$router->get('packages/charged', 'PackageController@chargedToday');
$router->patch('packages/organize', 'PackageController@personalOrder');
$router->get('packages/{id}', 'PackageController@findByID');
$router->patch('packages/{id}', 'PackageController@editPackage');