<?php

class AvtorizationController extends BackParentController {

    public $pageTitle;
    public $defaultAction = 'login';

    public function init() {
        parent::init();
        $this->pageTitle = Translater::getDictionary()->avtorisationTitle;
    }

    public function actionLogin() {
        var_dump(Yii::app()->user->returnUrl);
        if (Yii::app()->user->isGuest) {
            Yii::import("application.models.Admin", true);
            $model = new Admin();
            if (isset($_POST['Admin'])) {
                $model->attributes = $_POST['Admin'];
                $identity = new UserIdentity($model->user_login, $model->user_password);
                $auth = $identity->authenticate();
                if ($auth["authenticate"]) {
                    $time = isset($model->rememberMe) ? 3600 * 24 * 30 : 0;
                    Yii::app()->user->login($identity, $time);
                    //var_dump(Yii::app()->user->returnUrl);
                    $this->redirect(Setting::in()->mainAdminpage);
                } else {
                    $error = Translater::getDictionary()->$auth["authenticate_error"];
                    $this->render('/common/login', array('error' => $error, "model" => $model));
                }
            } else {
                $this->render('/common/login', array('error' => "", "model" => $model));
            }
        } else {
            $this->redirect(Setting::in()->mainAdminpage);
        }
    }

    public function actionLogout() {
        Yii::app()->user->logout();
        if ($_SERVER["HTTP_REFERER"] != "") {
            $this->redirect($_SERVER["HTTP_REFERER"]);
        } else {
            $this->redirect("/login");
        }
    }

}

?>
