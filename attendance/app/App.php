<?php

declare(strict_types = 1);

namespace app;

use resources\View\View;
use App\Services\Router;
use App\Services\DB;

class App{

    public static DB $db;
    private static View $view;
    private Router $router;
    public static $session;
    public static $user;
    
    public function __construct($router){
    
        
        $this->router = $router;
        self::$view = new View();
        self::$db = new DB();

    }

    public function render($request_uri,$request_method):void
    {
       echo $this->router->render($request_uri,$request_method);
    }

    public static function updateViewPath($path):void
    {
        self::$view->setPath($path);
    }

    public static function getView():\src\View\View
    {
        return self::$view;
    }

}