<?php

class BlockpositionController extends BackController {

    protected $basicRigth = "managePosition";

    public function init() {
        parent::init();
        $this->breadcrumb = array(
            array("name" => Translater::getDictionary()->blockmanagerName, "action" => $this->createUrl("/blockmanager/")),
            array("name" => Translater::getDictionary()->blockmanagerpositionName, "action" => $this->createUrl("/blockmanager/blockposition/")),
        );
    }

    public function actionIndex() {
        $models = Blockposition::model()->findAll();
        $this->render('index', array('models' => $models,));
    }

    public function actionCreate() {
        $model = new Blockposition;
        if (isset($_POST['BlockPosition'])) {
            $model->attributes = $_POST['BlockPosition'];
            if ($model->save())
                $this->redirect($this->createUrl("/blockmanager/blockposition/"));
        }
        $this->render('create', array('model' => $model,));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        if (isset($_POST['BlockPosition'])) {
            $model->attributes = $_POST['BlockPosition'];
            if ($model->save())
                $this->redirect($this->createUrl("/blockmanager/blockposition/"));
        }

        $this->render('update', array('model' => $model,));
    }

    public function actionDelete($id=false) {
        if ($id) {
            $model = $this->loadModel($id);
            $model->delete();
        } else if (!empty($_POST["position_id"])) {
            foreach ($_POST["position_id"] as $id) {
                $model = $this->loadModel($id);
                $model->delete();
            }
        }
        $this->redirect($this->createUrl("/blockmanager/blockposition/"));
    }

}

?>