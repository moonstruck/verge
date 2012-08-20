<?php

ini_set('display_errors', 'On');
error_reporting(E_ERROR | E_PARSE);

define('ROOT', '/var/www/verge');

function get($route, $callback) {
    Bones::register($route, $callback);
}

class Bones {
    private static $instance;
    public static $route_found = false;

    public $route = '';
    public $content = '';
    public $vars = array();
    
    public function __construct() {
        $this->route = $this->get_route();
    }

    public static function get_instance() {
        if (!isset (self::$instance)) {
            self::$instance = new Bones();
        }

        return self::$instance;
    }
    

    protected function get_route() {
        parse_str($_SERVER['QUERY_STRING'], $route);
        if ($route) {
            return '/' . $route['request'];
        } else {
            return '/';
        }
    }

    public static function register($route, $callback) {
        $bones = static::get_instance();

        if ($route == $bones->route && !static::$route_found) {
            static::$route_found = true;
            echo $callback($bones);
        } else {
            return false;
        }
    }

    public function set($index, $value) {
        $this->vars[$index] = $value;
    }

    public function render($view, $layout = "layout") {
        $this->content = ROOT . '/views/' . $view . '.php';
        foreach ($this->vars as $key => $value) {
            $$key = $value;
        }

        if (!$layout) {
            include($this->content);
        } else {
            include (ROOT . '/views' . $layout . '.php');
        }
    }
}
