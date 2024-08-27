<?php

namespace app\Models;

use App\App;

class Model{

    protected ?string $table = null ;
    /**returns a particular entry based on the field value
     * if entry is not found, False is returned
     * @param string $field
     * @return Model|bool
     */

    public function findOrFail(string|array $fields="id"){
        $query = "SELECT * FROM {$this->get_table()} {$this->get_where($fields)}";
    
        $result = App::$db->read($query,$fields);

    
        if((bool)$result){
            $result = $result->fetch(\PDO::FETCH_OBJ);
            return $result;
        }else{
           return false;
        }
    }

    /**returns all the entries of a particular model */
    public function all(){
        $query = "SELECT * FROM {$this->get_table()}";

        $result = App::$db->read($query);

        return $result->fetchAll();

    }

    /**
     * returns the name of the table
     */
    protected function get_table(){

        if(is_null($this->table)){
                    
            $table = strtolower(get_class($this));
            $table = explode("\\",$table);
            $table = array_reverse($table);
            $table=$table[0]."s";

            return $table;

        }else{
            return $this->table;
        }
    }

    private function get_where(array|string $fields){

        $query = "where ";

        if(is_array($fields)){
            $keyCount = 0;
            //add each element in the array to the query
            foreach($fields as $key=>$field){

                $string = " {$key}=:{$key}";
                $query.=$string;
                
                if($keyCount <  count($fields)-1){
                    $query.=" and ";
                }
                $keyCount++;
            }
        }else{
            $string= " id=:id";
            $query.=$string;
        }


        return $query;
    }

}