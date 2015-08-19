<?php
require_once 'init.php';
$sc=new SchemaBuilder('omar',['ID'=>'INT']);
$sc->DropForiegnKey("ID", "ID", "user");
