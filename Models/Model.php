<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model
 *
 * @author Omar Moustafa
 */
abstract class Model implements ModelInterface{
    public $observer;
    public $table;
    public $attributes;
    public $con;
    public $primary_key='ID';
    public function __construct() {
        $this->observer=  new Repository();
        $this->con=DB::getcon();
    }
    
    public function __set($property, $value) {
        if(array_key_exists($property, $this->attributes))
        {
            $this->attributes[$property] = $value;    
        }
    }
    
    public function __get($property) {
        if($this->attributes[$property])
        {
            return $this->attributes[$property];
        }
    }
    
    public function save()
    {
        if(!empty($this->attributes[$this->primary_key]))
        {
            $result=  $this->con->select($this->table, ["$this->primary_key"=>$this->attributes[$this->primary_key]]);
            if($result->rowCount()>0)
            {
                $this->con->update($this->table,  $this->attributes,["$this->primary_key"=>$this->attributes[$this->primary_key]]);
                
            }
            else
            {
                echo 'ID not found in database';
            }
        }
        else {
                $this->con->insert($this->table ,  $this->attributes);
                
             }
        $this->notify();
    }

        public function create($values)
    {
        $this->con->insert($this->table,$values);
    }
    public function __destruct() {
        
    }
    public function delete(){
      if(!empty($this->attributes[$this->primary_key]))
        {
            $result=  $this->con->select($this->table, ["$this->primary_key"=>$this->attributes[$this->primary_key]]);
            if($result->rowCount()>0)
            {
                $this->__destruct();
                $this->con->delete($this->table,[$this->primary_key=>  $this->attributes[$this->primary_key]]);
            }
            else {
                $this->__destruct();
            }
        }
    }
       
    public function notify()
    {
        $this->observer->update($this);
    }
}
