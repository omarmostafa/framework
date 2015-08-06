<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataBaseClass
 *
 * @author Omar Moustafa
 */
class DB {
    private $connection;
       
        private static $con;
        
        public  $database;
        public  $object;
        private function __construct() {  
          try
            {
             $this->connection = new PDO("mysql:host=".Config::get('db.mysql.host').";dbname=".Config::get('db.mysql.db')."",Config::get('db.mysql.user'),Config::get('db.mysql.pass'));
             
            $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
           // $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
            }
        catch (PDOException $e)
            {
               echo $e->getMessage();
            die();}
            
        return $this->connection;
  }
        /**
         * 
         * @return type
         */
        public static function getcon()
        {
            if(self::$con==null)
                {
                    self::$con=new DB();
                }
            return  self::$con;
        }
       /**
        * 
        * @param type $sql
        * @return type
        */
       public function SetFetchMode($result) {
           $result->setFetchMode(PDO::FETCH_CLASS,  $this->object);
           
       }
        public function query($sql)
        {
            $result =$this->connection->prepare($sql);
            $this->SetFetchMode($result);
            $result->execute();
            return $result;
	}
        
        /**
         * 
         * @param type $table
         * @param type $values
         */
       public function select($table , $values = [],$select=[])
       {
           
           
           $selection=  $this->resolveSelection($select);
          // print_r($select);
           $params = $this->resolveParams($values);
           $stmt = "SELECT {$selection} FROM {$table} $params";
      //   echo $stmt;
           return $this->query($stmt);
       }
        public function resolveSelection($values)
       {
           $selection='';
           if(empty($values))
           {
               $selection  .= ' * ';
           }
           else
           {
               $x=0;
               // counter for the last value
               
               foreach($values as $value)
               {
                   if($x>0)
               {
                       $selection.=',';
                   }
                   $selection .= " $value ";
                   $x++;
               }
               
           }
           return $selection;
       }
  public function selectOne($table , $where = [] ,$select=[])
       {
          $result=  $this->select($table , $where ,$select);
           return $result->fetch();
       }
       
       public function selectALL($table , $where = [],$select=[])
       {
           $result=  $this->select($table , $where ,$select);
           return $result->fetchAll();
       }
       /**
        * 
        * @param type $array
        */
       private function resolveParams($array)
       {
           $string='';
           $x= 0;
           
           if(is_array($array)&& !empty($array))
           {
               $string.= "WHERE";
               
               foreach($array as $key => $value)
               {
                   if($x > 0)
                   {
                       $string .= " AND ";
                   }
                   
                   $string .= " {$key} = \"{$value}\" ";
                   
                   $x++;
               }
           }
           return $string;
       }
       
       /**
        * 
        * @param type $table
        * @param type $values
        * @return type
        */
      public function insert($table , $values = [])
       {
           $params = $this->Paramsasinsert($values);
           $stmt = "INSERT INTO {$table} {$params}";
           //echo $stmt;
         $result=  $this->query($stmt);
         return $result;
       }
       
       /**
        * 
        * @param type $array
        * @return string
        */
       public function getKey($x,$key,$y)
       {
           $string='';
               if($x > 0)
                   {
                       $string .= ",";
                      
                   }
                   if($y==0)
                   {
                   $string .= $key;
                   }
                   else if($y==1)
                   {
                       $string.="\"{$key}\"";
                   }
                   return $string;
       }
       private function Paramsasinsert($array)
       {
           $string = '';
           
           $x= 0; // attributes counter
           $a=0;  // values counter
           if(is_array($array))
           {
               $string.="(";
               foreach($array as $key => $value)
               {
                   $string.=$this->getKey($x, $key,0);
                 $x++;
               }
               $string.=") VALUES (";
               
          foreach($array as $key => $value)
               {
                $string.=$this->getKey($a, $value,1);
                  
                   $a++;
               }
               $string.=")";
           }
           return $string;
       }
 
        public function delete($table , $values = [])
        {
           $params = $this->resolveParams($values);
           $stmt = "DELETE FROM {$table} {$params}";
           
         $result=  $this->query($stmt);
         return $result;
       }

        
       /**
        * 
        * @param type $table
        * @param type $values
        * @param type $where
        * @return type
        */
       public function update($table , $values = [] , $where=[])
       {
           $params = $this->paramsasupdate($values, $where);
           $stmt = "UPDATE {$table} {$params}";
         //  echo $stmt;
         $result=  $this->query($stmt);
         return $result;
       }
        private function paramsasupdate($array,$where)
       {
           $string = '';
           $x= 0;
           $a=0;
           if(is_array($array)&& $array!=[])
           {
               $string.='SET';
               foreach($array as $key => $value)
               {
                   if($x > 0)
                   {
                       $string .= ",";
                   }
                   $string .= " {$key} = \"{$value}\" ";
                   $x++;
               }
           }
         $string.=  $this->resolveParams($where,$string);
 
           return $string;
       }
}

