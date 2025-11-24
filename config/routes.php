<?php 

$routes = array(
	'/test' => 'test#index'
);
$routes['/tasks'] = 'Tasks#index';
$routes['/tasks/index'] = 'Tasks#index';
$routes['/tasks/create'] = 'Tasks#create';
$routes['/tasks/store'] = 'Tasks#store';
$routes['/tasks/edit'] = 'Tasks#edit';
$routes['/tasks/update'] = 'Tasks#update';
$routes['/tasks/delete'] = 'Tasks#delete';