<?php


class CMyHttpException extends CHttpException {

    public function __construct($status, $message=null, $code=0) {
        parent::__construct($status, $message, $code);
        $this->analyzeException();
    }

    protected function analyzeException() {
        switch ($this->statusCode) {
            case 404 : {
                    Yii::app()->request->redirect(Yii::app()->controller->createUrl("/system/system/404"));
             }
        }
    }

}



?>
