<?php

class Exceptions  {
 
    private static $instance;
    static private $if_exeption=false;
    private $exceptions_array;
    
   private function __construct() {
        
   }
    
   private function addToArrayExceptions($text) {
       $this->exceptions_array[]=$text;
   }
   
   static public function setExeption($text) {
        if (empty(self::$instance)) {
            self::$instance = new Exceptions();
            self::$if_exeption=true;
        } 
        self::$instance->addToArrayExceptions($text);
   }
   

   
   static public function readExeption() {
        if (self::$if_exeption) {
            var_dump(self::$instance->exceptions_array);
            exit;
        } else {
            return false;
        }
    }

}

?>
