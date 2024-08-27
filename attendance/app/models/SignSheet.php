<?php

namespace App\Models;

use App\Models\Model;
use App\App;

class SignSheet extends Model{
    protected ?string $table = "signed_sheets";

    public string $studentId;
    public string $sheetId;
    public string $courseId;


    public function create(){
        $db_connecton = App::$db;


        $query = "INSERT into {$this->get_table()}(student_id,sheet_id,course_id) Values(:studentId,:sheetId,:courseId)";

       
        $result = $db_connecton->create($query,[
            "studentId"=>$this->studentId,
            "sheetId"=>$this->sheetId,
            "courseId"=>$this->courseId
        ]);

        if($result){
            return true;
        }else{
            return false;
        }

        
    }
}