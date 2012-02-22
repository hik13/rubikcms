<?php
class Time {
    public static  function getCurrentTime() {
        return mktime(date("H"),date("i"),date("s"),date("n"), date("j"), date("Y"));
    }


   public static function get_random_id($counter=99999999) {
        mt_srand(time()+(double)microtime()*1000000);
        return mt_rand(1,$counter);
    }

    public static function getDateTime($timest) {
        return date("m.d.Y - H:i:s",$timest);
    }

}
?>
