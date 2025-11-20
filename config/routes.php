<?php 

$routes = array(
	'/test' => 'test#index'
);

$routes['/categories'] = 'Categories#index';
$routes['/categories/index'] = 'Categories#index';
$routes['/categories/create'] = 'Categories#create';
$routes['/categories/store'] = 'Categories#store';
$routes['/categories/edit/:id'] = 'Categories#edit';
$routes['/categories/update/:id'] = 'Categories#update';
$routes['/categories/delete/:id'] = 'Categories#delete';

