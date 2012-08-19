<?php
include 'lib/bones.php';

get('/', function($app) {
    echo "Home";
});

get ('/signup', function ($app){
    echo "SignUp!";
});

get ('/test', function($app){
    echo "Route Test!";
});
