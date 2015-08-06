<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Repository
 *
 * @author Omar Moustafa
 */
class Repository implements RepoInterface{
    public $con;
    public $table;
    public function __construct()
    {
        
        $this->con = DB::getcon();
    }
    public function __call($method,$param) {
        
         preg_match("/[A-Z]*[a-z]*$/", $method,$partmethod);
         $key=$partmethod[0];
         $value=["$key"=>"$param[0]"];
         
        return $this->con->selectAll($this->table, $value);
 
    }
    public function findALL( $value=[])
    {
        return $this->con->selectAll($this->table, $value);
    }
    
    public function findOne( $value)
    {
        return $this->con->selectOne($this->table , $value);
    }
    public function find_by_sql($sql)
    {
        $result=  $this->con->query($sql);
        return $result->fetchAll();
    }

    public function update(\ModelInterface $model)
    {
        echo get_class($model).'Has Been Updated';
    }
}
