<?php

class ResponseAjax {

    static public $object;
    public $responseText;
    public $responseStatus = true;
    public $responseErrors = array();

    static public function getObject() {
        if (!empty(self::$object)) {
            return self::$object;
        } else {
            return self::$object = new ResponseAjax();
        }
    }

    static public function setResponseText($text) {
        $b = self::getObject();
        $b->responseText = $text;
    }

    static public function setResponseError($errorText) {
        $b = self::getObject();
        $b->responseStatus = false;
        $b->responseErrors = $errorText;
    }

    static public function jsonRspObj() {
        return json_encode(self::getObject());
    }

}

?>
