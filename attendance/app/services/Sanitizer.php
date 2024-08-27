<?php

namespace app\services;

class Sanitizer{

    public static function clean($data){
       $data = htmlspecialchars($data);
       $data = stripslashes($data);
       $data = filter_var($data,FILTER_SANITIZE_STRING);
        return $data;
    }

}