<?php
namespace App\Models;

use App\App;
use App\Models\Model;

class Sheet extends Model{

    public $course;
    public $date;  
    public $adminId;
    public $status;

    public function __construct(){
        $this->date = time();
        
    }

    public function create(){

        
        $db_connecton = App::$db;


        $query = "INSERT into {$this->get_table()}(course,admin_id,status) Values(:course,:admin_id,:status)";
        
        $result = $db_connecton->create($query,[
            "course"=>$this->course,
            "admin_id"=>$this->adminId,
            "status"=>$this->status
        ]);

        if($result){
            return true;
        }else{
            return false;
        }
    }


}