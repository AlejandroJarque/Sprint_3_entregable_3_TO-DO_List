<?php 

$routes = array(
	'/test' => 'test#index'
);

$routes['/'] = 'Home#index';
$routes['/home'] = 'Home#index';
$routes['/home/index'] = 'Home#index';