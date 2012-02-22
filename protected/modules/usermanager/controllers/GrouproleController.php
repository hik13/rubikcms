<?php

class GroupRoleController extends BackController {

    protected $basicRigth = "manageGroupRole";

    public function init() {
        parent::init();
        $this->breadcrumb = array(
            array("name" => Translater::getDictionary()->usermanager_name, "action" => $this->createUrl("/usermanager/")),
            array("name" => Translater::getDictionary()->groupmanager_name, "action" => $this->createUrl("/usermanager/grouprole/"))
        );
    }

    public function actionIndex() {
        $model = new GroupRole();
        $this->render('index', array('groups' => $model->findAll()));
    }

    public function actionCreate() {
        $model = new GroupRole;
        if (isset($_POST['GroupRole'])) {
            $model->attributes = $_POST['GroupRole'];
            $model->group_permission = $_POST['GroupRole']["group_permission"];
            if ($model->save())
                $this->redirect($this->createUrl("/usermanager/grouprole/"));
        }
        $this->render('create', array(
            'model' => $model, 'permission' => Module::model()->with("permission")->findAll()));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        if (isset($_POST['GroupRole'])) {
            $model->attributes = $_POST['GroupRole'];
            $model->group_permission = $_POST['GroupRole']["group_permission"];
            if ($model->save()) {
                $this->redirect($this->createUrl("/usermanager/grouprole/"));
            }
        }
        $this->render('update', array('model' => $model, 'permission' => Module::model()->with("permission")->findAll()));
    }

    public function actionDelete($id=false) {
        if ($id) {
            $this->loadModel($id)->delete();
        } else if (!empty($_POST["group_role_id"])) {
            foreach ($_POST["group_role_id"] as $id) {
                $this->loadModel($id)->delete();
            }
        }
        $this->redirect($this->createUrl("/usermanager/grouprole/"));
    }

    public function loadModel($id) {
        $model = GroupRole::model()->findByPk((int) $id);
        if ($model === null)
            $this->redirect($this->createUrl("/system/system/404"));
        return $model;
    }

}
