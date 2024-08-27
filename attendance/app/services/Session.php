<?php

namespace app\services;
use src\Exception\InvalidSession;

class Session{

    public function get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }

        throw new InvalidSession();
    }

    public function store($key,$value){
        try{
            $_SESSION[$key] = $value;
        }catch(\Exception){
            echo "failed to store session";
        }
        
    }
    public function check($key){
        if(isset($_SESSION[$key])){
            return true;
        }

        return false;
    }

    public function isActive(){
        if(isset($_SESSION["active-user"])){
            return true;
        }

        return false;
    }
}