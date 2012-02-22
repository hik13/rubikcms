<?php
class TimeEx {

    static private $start;
    static private $stop;


    static private function Timer() {
        $mtime = microtime();
        $mtime =explode(" ",$mtime);
        $mtime = $mtime[1] + $mtime[0];
        return  $mtime;
    }


    static public function StartScript() {
        self::$start=self::Timer();
    }

    static public function StopScript($num=false) {
        self::$stop=self::Timer();
        $totaltime =self::$stop - self::$start;
        if ($num) $totaltime=$totaltime/$num;
        echo "Страница сгенерирована за $totaltime  секунд !";
    }
        static public function getStopScript() {
        self::$stop=self::Timer();
        return  $totaltime =self::$stop - self::$start;
       // echo "Страница сгенерирована за $totaltime  секунд !";
    }

}
?>
