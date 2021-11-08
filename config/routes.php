<?php

use Pecee\Http\Request;
use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/', 'HomeController@home');
SimpleRouter::all('/enregistrement', 'UserController@registerMyAccount');
SimpleRouter::all('/verification/{token?}', 'UserController@verifyEmailAddress', ['token']);
SimpleRouter::all('/mot-de-passe-enregistre', 'UserController@registered');
SimpleRouter::all('/mot-de-passe-oublie', 'UserController@password');
SimpleRouter::post('/mot-de-passe-envoye', 'UserController@sendEmailForNewPassword');
SimpleRouter::all('/creer-nouveau-mot-de-passe/{token?}', 'UserController@createNewPassword', ['token']);
SimpleRouter::get('/login', 'UserController@login');
SimpleRouter::post('/login-verification', 'UserController@authenticate');
SimpleRouter::get('/admin', 'AdminController@admin');
SimpleRouter::all('/creer-un-article', 'AdminController@createPost');
SimpleRouter::get('/liste-articles', 'AdminController@listPosts');
SimpleRouter::all('/editer-un-article/{idPost?}', 'AdminController@editPost', ['idPost']);
SimpleRouter::all('/supprimer-un-article', 'AdminController@deletePost');
SimpleRouter::post('/poster-un-commentaire/{idPost?}', 'CommentController@postComment', ['idPost']);
SimpleRouter::all('/valider-un-commentaire', 'CommentController@validateComment');
SimpleRouter::all('/invalider-un-commentaire', 'CommentController@invalidateComment');
SimpleRouter::all('/contact', 'ContactController@contact');
SimpleRouter::get('/gerer-commentaires', 'AdminController@manageComments');
SimpleRouter::all('/profil', 'UserController@profile');
SimpleRouter::get('/a-propos', 'HomeController@aPropos');
SimpleRouter::all('/gerer-les-contacts', 'ContactController@displayContactList');
SimpleRouter::all('/valider-un-contact', 'ContactController@validateContact');
SimpleRouter::all('/invalider-un-contact', 'ContactController@invalidateContact');
SimpleRouter::all('/repondre-contact/{idContact?}', 'ContactController@answerContact', ['idContact']);
SimpleRouter::get('/blog', 'BlogController@blog');
SimpleRouter::get('/blog/articles/{idPost?}/{slug?}', 'BlogController@openPost', ['slug', 'idPost']);
SimpleRouter::get('/politique-de-confidentialite', 'PrivacyController@privacy');
SimpleRouter::get('/deconnexion', 'UserController@deconnect');
SimpleRouter::get('/404', 'ErrorController@error404');
SimpleRouter::get('/403', 'ErrorController@error403');
SimpleRouter::get('/405', 'ErrorController@error405');
SimpleRouter::get('/500', 'ErrorController@error500');

SimpleRouter::error(function(Request $request, \Exception $exception) {

    switch($exception->getCode()) {
        // Page not found
        case 404:
            response()->redirect('/404');
        // Forbidden
        case 403:
            response()->redirect('/403');
        // Unauthorized method
        case 405:
            response()->redirect('/405');
        // Server error
        case 500:
            response()->redirect('/500');
        // Default error
        default:
            $request->setRewriteCallback('ErrorController@error404');
    }
    
});

