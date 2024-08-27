<?php

require "../vendor/autoload.php";
require "../config/config.php";

use App\Services\Router;
use App\Controllers\{Admin,Auth,Student};
use App\App;

session_start();

//instantiate router 

try{
    $myRouter = new Router();

    $myRouter->get("/",[Auth::class,"login"])
            ->get("login/",[Auth::class,"login"])
            ->get("admin/dashboard",[Admin::class,"Dashboard"])
            ->post("generate/",[Admin::class, "generate"])
            ->post("close/",[Admin::class, "close"])
            ->post("logout/",[Auth::class, "logout"])
            ->post("student/sign",[Student::class, "sign"])
            ->get("student/dashboard",[Student::class,"Dashboard"])
            ->post("login/",[Auth::class,"login_user"])
            ->get("register/",[Auth::class,"register"])
            ->post("register/",[Auth::class,"register_user"]);

    (new app($myRouter))->render($_SERVER["REQUEST_URI"],$_SERVER["REQUEST_METHOD"]);
    
}catch(Exception $e){
    echo $e->getMessage();
}