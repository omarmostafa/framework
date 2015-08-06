<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserRepository
 *
 * @author Omar Moustafa
 */

class UserRepository extends Repository{
    
   // public $name,$email,$password,$age,$gender;
   public function __construct() {
       parent::__construct();
       $this->con->object='User';
       $this->table='user';
   }

    
}
    

    
    

