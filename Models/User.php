<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Omar Moustafa
 */
class User extends Model{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->con->object='User';
    }
    public $attributes = ['ID'=>'','name'=>'','password'=>'','email'=>'','age'=>'','gender'=>''];
    public $table='user';
}
