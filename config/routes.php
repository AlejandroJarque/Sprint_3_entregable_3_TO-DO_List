<?php 

$routes = array(
	'/test' => 'test#index'
);


$routes['/'] = 'Home#index';
$routes['/home'] = 'Home#index';
$routes['/home/index'] = 'Home#index';

$routes['/tasks'] = 'Tasks#index';
$routes['/tasks/index'] = 'Tasks#index';
$routes['/tasks/create'] = 'Tasks#create';
$routes['/tasks/store'] = 'Tasks#store';
$routes['/tasks/edit/:id'] = 'Tasks#edit';
$routes['/tasks/update/:id'] = 'Tasks#update';
$routes['/tasks/delete/:id'] = 'Tasks#delete';

$routes['/categories'] = 'Categories#index';
$routes['/categories/index'] = 'Categories#index';
$routes['/categories/create'] = 'Categories#create';
$routes['/categories/store'] = 'Categories#store';
$routes['/categories/edit/:id'] = 'Categories#edit';
$routes['/categories/update/:id'] = 'Categories#update';
$routes['/categories/delete/:id'] = 'Categories#delete';


