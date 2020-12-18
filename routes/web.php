<?php

$router->post('users/login', 'UserController@login');

//$router->get('packages', 'UserController@login');
$router->get('packages/today', 'PackageController@toDeliverToday');
$router->get('packages/{id}', 'PackageController@findByID');
$router->patch('packages/{id}', 'PackageController@login');