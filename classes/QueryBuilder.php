<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryBuilder
 *
 * @author omar
 */
class QueryBuilder {
    private static $con;
    private function __construct() {  

  }
    public static function getcon()
        {
            if(self::$con==null)
                {
                    self::$con=new QueryBuilder();
                }
            return  self::$con;
        }
    public function CreateDB($DBName)
    {
        $stmt="CREATE DATABASE ".$DBName."";
        return $stmt ;
    }
    public function CreateTable($table,$attribute=[]) {
        $string=  $this->resolve_attr($attribute);
        $stmt="CREATE TABLE $table ($string)";
        return $stmt;
    }
    public function UpdateTable($table,$attributes,$status) {
        $string=  $this->resolve_attr($attributes);
        $stmt="ALTER TABLE $table $status ($string)";
        return $stmt;
    }
    public function DropTable($table)
    {
        $stmt="DROP TABLE $table";
        return $stmt;
    }

    public function primaryKey($table,$coloumn)
    {
        $stmt="ALTER TABLE $table ADD CONSTRAINT PRIMARY KEY ($coloumn)";
        return $stmt;
    }
    public function resolve_attr($attribute=[]) {
        $string='';
        $count=0;
        if(is_array($attribute)&& !empty($attribute))
        {
            
            foreach ($attribute as $key => $value) {
                if($count>0)
                {
                    $string.=' , ';
                }
                $string.="{$key} {$value}";
                $count++;
            }
            
        }
        return $string;
    }
}
