<?php

namespace App\Models;

use App\Models\Model;
use App\App;

class Category extends Model{

    protected string $table = "categories";

    public function get_categories(){

        $query = "Select {$this->table}.id as categoryID, {$this->table}.name as category_name, icons.id, icons.name From {$this->table} JOIN icons where icons.id= {$this->table}.icon_id";
        
        $result = App::$db->read($query);

    
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

}