<?php

class Admin extends CFormModel {

    public $user_login;
    public $user_password;
    public $rememberMe = false;

    public function rules() {
        return array(
            array('user_login, user_password', 'required'),
            array('rememberMe', 'boolean'),
        );
    }

    public function attributeLabels() {
        return array(
            'user_login' => Translater::getDictionary()->avtorisationLogin,
            'user_password' => Translater::getDictionary()->avtorisationPassword,
            'rememberMe' => Translater::getDictionary()->avtorisationRememberMe,
        );
    }

}

?>
