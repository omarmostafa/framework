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
        $string=  $this->resolve_attr($attribute,'Create');
        $stmt="CREATE TABLE IF NOT EXISTS $table ($string)";
       // echo $stmt;
        return $stmt;
    }
    public function UpdateTable($table,$attributes,$status) {
        $string=  $this->resolve_attr($attributes,'Update',$status);
        $stmt="ALTER TABLE $table $string";
       
        return $stmt;
    }
    public function DropTable($table)
    {
        $stmt="DROP TABLE $table";
        return $stmt;
    }

    public function primaryKey($table,$coloumn)
    {
        $string=  $this->resolve_primary($coloumn);
        $stmt="ALTER TABLE $table ADD CONSTRAINT PRIMARY KEY ($string)";
        
        return $stmt;
    }
    
        public function rename_table($from,$to)
    {
        $stmt="ALTER TABLE $from RENAME TO $to";
        return $stmt;
    }
            public function ModifyColumn($table,$attributes)
    {
        $string=  $this->resolve_attr($attributes,'MODIFY');
        $stmt="ALTER TABLE $table $string";
        
        return $stmt;
    }
    public function auto_increment($table,$coloumn)
    {
        
        $stmt="ALTER TABLE $table MODIFY COLUMN $coloumn INT auto_increment";
        
        return $stmt;
    }
       public function DrobPrimaryKey($table)
    {
        
        $stmt="ALTER TABLE $table DROP PRIMARY KEY";
        
        return $stmt;
    }
       public function foriegn_key($table,$primarykey,$foriegn_key,$primary_key_table)
    {
        
        $stmt="ALTER TABLE $table ADD CONSTRAINT fk_{$table}_{$foriegn_key}_{$primarykey}_{$primary_key_table} FOREIGN KEY ($foriegn_key) REFERENCES $primary_key_table($primarykey)"; 
        return $stmt;
    }
           public function dropForiegnKey($table,$primarykey,$foriegn_key,$primary_key_table)
    {
        
        $stmt="ALTER TABLE $table DROP FOREIGN KEY fk_{$table}_{$foriegn_key}_{$primarykey}_{$primary_key_table} "; 
        return $stmt;
    }
      public function resolve_primary($attribute) {
        $string='';
        $count=0;
        if(is_array($attribute)&& !empty($attribute))
        {
           
            foreach ($attribute as $value) {
                if($count>0)
                {
                    $string.=' , ';
                }
                $string.="{$value} ";
                
                $count++;
            }
         
        }
        return $string;
    }
    public function resolve_attr($attribute=[],$status='',$status_update='') {
        $string='';
        $count=0;
        if(is_array($attribute)&& !empty($attribute))
        {
           // $string.='(';
            foreach ($attribute as $key => $value) {
                if($count>0)
                {
                    $string.=' , ';
                }
                if($status=='Update')
                {
                    $string.="$status_update ";
                }
             if($status=='MODIFY')
                {
                    $string.="MODIFY ";
                }
                
                $string.="{$key} {$value} ";
                if($status=='Create' || $status_update=='ADD' || $status=='MODIFY')
                {
                    $string.='NOT NULL';
                }
                $count++;
            }
           // $string.=')';
        }
        return $string;
    }
}
