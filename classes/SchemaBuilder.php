<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SchemaBuilder
 *
 * @author omar
 */

class SchemaBuilder {
    public $con;
    public $query_builder;
    public $table;
    public function __construct($table,$attributes=[]) {  
        $this->query_builder=  QueryBuilder::getcon();
        $this->con=  DB::getcon();
        $this->table=$table;
       $sql= $this->query_builder->CreateTable($table,$attributes);
        $this->con->exec($sql);
  }
  public function add($attribute) {
      $sql= $this->query_builder->UpdateTable($this->table,$attribute,'ADD');
      $this->con->exec($sql);
  }
    public function drop($column_name) {
        $attribute=[$column_name=>''];
      $sql= $this->query_builder->UpdateTable($this->table,$attribute,'DROP COLUMN');
      $this->con->exec($sql);
  }
        public function drop_table() {
        
      $sql= $this->query_builder->DropTable($this->table);
      $this->con->exec($sql);
      
  }
    public function primary_key($column) {
        
      $sql= $this->query_builder->primaryKey($this->table,$column);
      $this->con->exec($sql);
      
  }
      public function rename_table_to($to) {
        
      $sql= $this->query_builder->rename_table($this->table,$to);
      $this->con->exec($sql);
      
  }
        public function Modify_column($attributes) {
        
      $sql= $this->query_builder->ModifyColumn($this->table,$attributes);
      $this->con->exec($sql);
      
  }
          public function auto_increment($column) {
        
      $sql= $this->query_builder->auto_increment($this->table,$column);
      $this->con->exec($sql);
      
  }
         public function DropPrimaryKey() {
        
      $sql= $this->query_builder->DrobPrimaryKey($this->table);
      $this->con->exec($sql);
      
  }
     public function Foriegn_key($foriegn_key,$primarykey,$primary_key_table) {
        
      $sql= $this->query_builder->foriegn_key($this->table,$primarykey,$foriegn_key,$primary_key_table);
      $this->con->exec($sql);
      
  }
       public function DropForiegnKey($foriegn_key,$primarykey,$primary_key_table) {
        
      $sql= $this->query_builder->dropForiegnKey($this->table,$primarykey,$foriegn_key,$primary_key_table);
      $this->con->exec($sql);
      
  }
}
