<?php

class Randomizator {

    static private $upRandomLevel = 99999999;

    public static function get_random_number($limit=false) {
        $limit = $limit ? $limit : self::$upRandomLevel;
        return mt_rand(0, $limit);
    }

    public static function get_random_md5hash() {
        return md5(self::get_random_number() . self::get_random_number());
    }

    public static function getRandomArrayFrom($count, $array) {
        $rezult_array = array();
        $keys=array_rand($array,$count);
        foreach($keys as $key) {
            $rezult_array[$key]=$array[$key];
        }
        return $rezult_array;
    }

}

?>
