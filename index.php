<?php
include 'lib/bones.php';

get('/', function($app) {
    $app->set('message', 'Welcome Back!');
    $app->render('home');
});

get('/signup', function($app) {
    $app->render('signup');
});

get('/say/:message', function($app) {
    $app->set('message', $app->request('message'));
    $app->render('home');
});

post('/signup', function($app) {

    $user = new User();
    $user->name = $app->form('name');
    $user->email = $app->form('email');

    $app->couch->post($user->to_json);

    $app->set('message', 'Thanks for Signing Up ' . $app->form('name') . '!');  
    $app->render('home');
});
