<?php

declare(strict_types = 1);


namespace app\services;


class DB{

    private $conn;

    public function __construct(){
        try{
            $dsn = "mysql:host=localhost;dbname=".\DB_NAME.";";
            $this->conn = new \PDO($dsn,\DB_USER,\DB_PASS);

        }catch(\PDOEXCEPTION $e){

          echo $e->getMessage();
        }
    }
    public function connect(){
        return $this->conn;
    }

    public function read(String $query,array $param_set = null){

        try{
            
            $connection = $this->connect();
            $stmt = $connection->prepare($query);
           
            

                if(!is_null($param_set)){

                $keys = array_keys($param_set);
                $values = array_values($param_set);

                for($i = 0; $i < count($keys); $i++){
                    $stmt->bindValue($keys[$i],$values[$i]);
                }

                }
            $result = $stmt->execute();
           
            

            if($stmt == false){

                return false;
            }
            return $stmt;

        }catch(PDOEXCEPTION $e){
            http_response_code(500);
        }
    }

    public function create(String $query,array $param_set){

        $connection = $this->connect();
        $stmt = $connection->prepare($query);

        $num_rows = 0;

       // foreach($param_set as $param){

           // $param = (array)$param;

            $keys = array_keys($param_set);
            $values = array_values($param_set);

          //  var_dump($keys);
            //var_dump($values);

            foreach($values as $index=>$value){
                $stmt->bindValue(":".$keys[$index], $value);
            }

            if($result = $stmt->execute()){
                ++$num_rows;
            }
       // }
       
        return $num_rows;
    }

    public function update(String $query, array $param){

        $connection = $this->connect();

        $stmt = $connection->prepare($query);

        $keys = array_keys($param);
        $values = array_values($param);

        foreach($values as $index=>$value){
          
            $stmt->bindValue(":".$keys[$index], $value);
        }

        if($result = $stmt->execute()){
            http_response_code(200);
            return [
                "message"=> "Update was successfull"
            ];
        }

        return false;
        
    }


    public function delete(String $query,int $id){

        $connection = $this->connect();
        $stmt = $connection->prepare($query);

        $stmt->bindValue(":id",$id);
        $result = $stmt->execute();

        if($result){

            return [
                "message"=>"delete was successfull",
                "id"=>$id
            ];
    
        }

      return false;
    }

    
}