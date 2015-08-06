<?php
class Config
{

    public static function set($setter,$values) 
    {
        $partsetter=  explode(".", $setter);
        $firstsetter=$partsetter[0];
        $secondsetter=$partsetter[1];
        $thirdsetter=$partsetter[2];
        $GLOBALS['config'][$firstsetter][$secondsetter][$thirdsetter]=$values;
    }
    
    public static function get($getter) 
    {
        $partgetter=  explode(".", $getter);
        $firstgetter=$partgetter[0];
        $secondgetter=$partgetter[1];
        $thirdgetter=$partgetter[2];
        
        return $GLOBALS['config'][$firstgetter][$secondgetter][$thirdgetter];
    }
    
}
// Config::set('db.mysql.host','127.0.0.1');
// Config::set('db.mysql.db','app_pdo');
// Config::set('db.mysql.user','root');
// Config::set('db.mysql.pass','');
//
 