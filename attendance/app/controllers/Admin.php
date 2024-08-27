<?php

namespace App\Controllers;

namespace App\Controllers;
use App\Models\Course;
use resources\view\View;
use App\App;
use App\Models\{Sheet,SignSheet};

class Admin{

    public function dashboard(){

        if($this->isLoggedIn()){

            $userId = $_SESSION["user"]->id;
            //get all registrations
            $query = "SELECT courses.code, courses.unit FROM courses JOIN course_assignment where course_assignment.admin_id = $userId";
            $result = App::$db->read($query);
            $courses_taken = $result->fetchAll();
            $query = "SELECT users.fname,users.lname FROM users Join course_registration where users.type='1' and course_registration.student_id = users.id";
            $students_taking_course =  App::$db->read($query);
            $students_taking_course = $students_taking_course->fetchAll();
           
            //get total number of sheets
            $admin_id = $_SESSION["user"]->id;
            $query = "SELECT id FROM sheets where admin_id = $admin_id";

            $result = App::$db->read($query);
            $sheets = $result->fetchAll();

            //get all the courses
            $course_collection = (new Course)->all();
            $view = "admin_dashboard";
            $viewhandler = new View;
            $viewhandler->setPath($view);
            return $viewhandler->render(true,["sheets"=>$sheets,"registered"=>$students_taking_course,"course_collection"=>$courses_taken,"pageTitle"=>"Dashboard",]);

        }else{
            //redirect to home
            header("location:/attendance/login");
        }
       
    }

    public function generate(){
        //validate user 
        if($this->isLoggedIn() &&  $this->isAdmin()){

            extract($_POST);

            $sheet = new Sheet();

            $sheet->course = $courseId;
            $sheet->id = bin2hex($_SESSION["user"]->email.time());
            $sheet->adminId = $_SESSION["user"]->id;
            $sheet->status = "1";

            if($sheet->create()){
                echo "created";
            }else{
                echo "failed to create";
            }
        }else{
            http_response_code("402");
            echo "Forbidden";
        }
    }

    public function isLoggedIn(){
        return $_SESSION["login"];
    }

    public function isAdmin(){
        if(isset($_SESSION["user"]) && $_SESSION["user"]->type == "0"){
            return true;
        }
    }

    public function close(){

        extract($_POST);
        
        $query = "UPDATE sheets SET status='0' where id = :sheetId and admin_id=:adminId";
        $result = App::$db->update($query,["sheetId"=>$sheetId,"adminId"=>$adminId]);

        if($result){
            header("location:/attendance/admin/dashboard");
        }else{
            echo "problem";
        }
    }
}
