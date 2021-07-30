<?php

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/', 'HomeController@home');
SimpleRouter::get('/register', 'UserController@register');
SimpleRouter::get('/password', 'UserController@password');
SimpleRouter::get('/login', 'UserController@login');
SimpleRouter::post('/login', 'UserController@authenticate', ['idPost', 'password']);
SimpleRouter::get('/admin', 'AdminController@admin');
SimpleRouter::get('/creer-un-article', 'AdminController@createPost');
SimpleRouter::get('/liste-articles', 'AdminController@listPosts');
SimpleRouter::all('/editer-un-article/{idPost?}', 'AdminController@editPost', ['idPost']);
SimpleRouter::get('/gerer-commentaires', 'AdminController@manageComments');
SimpleRouter::get('/profil', 'AdminController@profile');
SimpleRouter::get('/a-propos', 'HomeController@aPropos');
SimpleRouter::get('/contact', 'ContactController@contact');
SimpleRouter::get('/blog', 'BlogController@blog');
SimpleRouter::get('/services', 'ServicesController@services');
SimpleRouter::get('/projets', 'ProjectsController@projects');
SimpleRouter::get('/politique-de-confidentialite', 'PrivacyController@privacy');
SimpleRouter::get('/error', 'ErrorController@error');