<?php

class UserController extends BackController {

    protected $basicRigth = "manageUser";

    public function init() {
        parent::init();
        $this->breadcrumb = array(
            array("name" => Translater::getDictionary()->usermanager_name, "action" => $this->createUrl("/usermanager/")),
        );
    }

    public function filters() {
        $array = parent::filters();
        $array[0] = $array[0] . ",setstatus";
        return $array;
    }

    public function actionIndex() {
        $model = new User();
        $this->render('index', array('users' => $model->findAll(), 'role' => $this->returnRole()));
    }

    public function actionCreate() {
        $model = new User();
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save())
                $this->redirect($this->createUrl("/usermanager/"));
        }
        $this->render('create', array('model' => $model, "role" => $this->returnRole()));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save())
                $this->redirect($this->createUrl("/usermanager/"));
        }
        $this->render('update', array('model' => $model, "role" => $this->returnRole()));
    }

    public function actionDelete($id=false) {
        if ($id) {
            $this->loadModel($id)->delete();
        } else if (!empty($_POST["user_id"])) {
            foreach ($_POST["user_id"] as $id) {
                $this->loadModel($id)->delete();
            }
        }
        $this->redirect($this->createUrl("/usermanager/"));
    }

    public function actionSetstatus() {
        if (!empty($_POST['id'])) {
            $model = $this->loadModel($_POST['id']);
            $model->user_status = $model->user_status == 0 ? 1 : 0; 
            $model->save();
        }
    }

    public function loadModel($id) {
        $model = User::model()->findByPk((int) $id);
        if ($model === null)
            $this->redirect($this->createUrl("/system/system/404"));
        return $model;
    }

    private function returnRole() {
        return GroupRole::model()->getKeyValueArray("group_role_id", "group_role_name", array("order" => "group_role_name"));
    }

}
