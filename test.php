<?php

require_once 'init.php';

$user = new UserRepository();
$result=$user->find_by_ID(19);
//var_dump($result);
foreach ($result as $user1) {
    //echo $user1->name.'<br>';
    //$user1->name='MOSTAFA';
  // echo $user1->name;
    $user1->delete();
    //echo $user2->name;
}
//
//$user2=new User();
////$user2->ID='3';
//$user2->name='MOSTAFA';
//$user2->password='123';
//$user2->email='mostafa@yahoo.com';
//$user2->age='21';
//$user2->gender='male';
////var_dump($user2->attributes);
//$user2->save();