<?php
include 'lib/bones.php';

define ('ADMIN_USER', 'root');
define ('ADMIN_PASSWORD', 'couchdb');

get('/', function($app) {
    $app->set('message', 'Welcome Back!');
    $app->render('home');
});

get('/signup', function($app) {
    $app->render('user/signup');
});

get ('/login', function($app){
    $app->render('user/login');
});

get('/say/:message', function($app) {
    $app->set('message', $app->request('message'));
    $app->render('home');
});

post('/signup', function($app) {

    $user = new User();
    $user->full_name = $app->form('full_name');
    $user->email = $app->form('email');
    
    $user->signup($app->form('username'), $app->form('password'));

    $app->set('success', 'Thanks for Signing Up' . $user->full_name . '!');

    //print_r( $user->_id);

    $app->render('home');

//     echo $user->full_name;
   
//     echo $user->name;
//     print_r($user);
//     var_dump($user);
// 
});

post('/login', function($app){
    $user = new User();
    $user->name = $app->form('username');
    $user->login($app->form('password'));

    $app->set('success', 'You are now loggen in!');
    $app->render('home');
});

get('/logout', function($app){
    User::logout();
    $app->redirect('/');
});

get('/user/:username', function($app){
    $app->set('user', User::get_by_username($app->request('username')));
    $app->set('is_current_user', ($app->request('username') == User::current_user() ? true : false));
    $app->render('user/profile');
});

post('/post', function($app){
    if (User::is_authenticated()) {
        $post = new Post();
        $post->content = $app->form('content');
        $post->create();
        $app->redirect('/user/' . User::current_user());
    } else {
        $app->set('error', 'You must be logged in to do taht.');
        $app->render('user/login');
    }
});

resolve();