<?php

namespace App\Models;

use App\Services\Db;
use App\App;

class User extends Model{
    
    //fields
    public string $fname;
    public string $lastname;
    public string $password;
    public string $type;
    public string $email;

    public function create(){

        $db_connecton = App::$db;


        $query = "INSERT into {$this->get_table()}(fname,lname,password,email,type) Values(:fname,:lname,:password,:email,:type)";
        
        $result = $db_connecton->create($query,[
            "fname"=>$this->fname,
            "lname"=>$this->lname,
            "password"=>password_hash($this->password,PASSWORD_DEFAULT),
            "type"=>$this->type,
            "email"=>$this->email
        ]);

        if($result){
            return true;
        }else{
            return false;
        }
    }
}