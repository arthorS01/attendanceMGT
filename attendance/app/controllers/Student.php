<?php


namespace App\Controllers;
use App\Models\Course;
use resources\view\View;
use App\App;

class Student{

    public function dashboard(){
        
        if($this->isLoggedIn()){
            //get all the courses
           $view = "student_dashboard";
           $viewhandler = new View;
           $viewhandler->setPath($view);

           $userId = $_SESSION["user"]->id;
          
  
           $query = "SELECT courses.id,courses.code, courses.unit, course_registration.instructor_id FROM courses JOIN course_registration where course_registration.student_id = $userId";
           $result = App::$db->read($query);
           $course_collection = $result->fetchAll();


           return $viewhandler->render(true,["courses_taken"=>$course_collection,"pageTitle"=>"Dashboard"]);

       }else{
           //redirect to home
           header("location:/attendance/login/");
       }
    }

    public function sign(){
        if($this->isLoggedIn()){

            extract($_POST);

           
            $sheet = new \App\Models\SignSheet;
            $sheet->studentId = $studentId;
            $sheet->sheetId = $sheetId;
            $sheet->courseId = $courseId;

           if($sheet->create()){
            header("location:/attendance/student/dashboard");
           }else{
            echo "problem boss";
           }

            
        }else{
            header("location:/attendance/login");
        }
        
    }
    public function isLoggedIn(){
        return $_SESSION["login"];
    }
}