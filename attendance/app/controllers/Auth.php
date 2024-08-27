<?php

namespace App\Controllers;

use resources\view\View;
use App\Models\{Category,Task};
use App\Services\Sanitizer;
use App\Models\User;
use App\App;

class Auth{

    public function login(){

        
        if($this->isLoggedIn()){
            $user = $_SESSION["user"];

            if($user){
               
                $_SESSION["login"] = true; 
                $_SESSION["user"] = $user;
                App::$user = $user;
                
                switch($user->type){
                    case "0":
                        header("location:admin/dashboard/");
                        break;
                    case "1":
                        header("location:student/dashboard");
                        break;
                }    
            }
        }else{
            $view_handler = new View;

            $view_handler->setPath("login");

            return $view_handler->render(true,["pageTitle"=>"ATMS| Login"]);
        }
        
    }

    public function register(){

       
        if($this->isLoggedIn()){
            $user = $_SESSION["user"];

            if($user){
               
                $_SESSION["login"] = true; 
                $_SESSION["user"] = $user;
                App::$user = $user;
                
                switch($user->type){
                    case "0":
                        header("location:admin/dashboard/");
                        break;
                    case "1":
                        header("location:student/dashboard");
                        break;
                }    
            }
        }else{
            $view_handler = new View;

            $view_handler->setPath("register");

            return $view_handler->render(true,["pageTitle"=>"ATMS| Login"]);
        }
        
    }

    public function register_user(){
        extract($_POST);
        //sanitize data
        $fname = Sanitizer::clean($fname);
        $lname = Sanitizer::clean($lname);
        $email = Sanitizer::clean($email);
        $pass = Sanitizer::clean($password);
        $acc_type = Sanitizer::clean($acc_type);

        if(empty($fname) || empty($lname) || empty($email) || empty($pass) || empty($acc_type)){
            //store error in session
            $_SESSION["register_error"]="All fields are required";
            //redirect to register page
            http_response_code(422);
            header("location:register/");
        }

        $user = new User();

        $user->fname = $fname;
        $user->lname = $lname;
        $user->email = $email;
        $user->password = $pass;
        $user->type = $acc_type;

        if($user->create()){
            echo "user created sucessfully";

        }else{
            echo "not done"; 
        }

    }


    public function login_user(){
        
        extract($_POST);
        //sanitize the data
        $email = Sanitizer::clean($email);
        $password = Sanitizer::clean($password);

        $userModel = new User();

        //validate the data
        $user = $userModel->findOrFail(["email"=>$email]);

        if($user){

            
            $_SESSION["login"] = true; 
            $_SESSION["user"] = $user;
            App::$user = $user;
            
            switch($user->type){
                case "0":
                    header("location:admin/dashboard/");
                    break;
                case "1":
                    header("location:student/dashboard");
                    break;
            }    
        }
    }

    public function isLoggedIn(){

        if(isset($_SESSION["login"])){
            return $_SESSION["login"];
        }
        return false;
    }
    public function logout(){
       //check if user is logged in
       if($this->isLoggedIn()){
            //clear the session
            session_destroy();
            header("location:/attendance/login");
       }
    }
}