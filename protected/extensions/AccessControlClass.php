<?php

class AccessControlClass {

    static public function checkAccess($right, CMyModule $modul) {
        if (in_array($modul->returnPermissions($right), Yii::app()->user->permission["permission"])) {
            return true;
        } else {
            return false;
        }
    }

}
?>
