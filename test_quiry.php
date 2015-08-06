<?php
require_once 'init.php';
echo QueryBuilder::getcon()->UpdateTable('user',["name"=>"string","ID"=>"int"],"ADD");
