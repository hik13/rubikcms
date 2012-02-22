<?php

class CatalogController extends BackController {

    protected $basicRigth = "manageObject";

    public function init() {
        parent::init();
        $this->breadcrumb = array(
            array("name" => Translater::getDictionary()->catalogmanager_CatalogName, "action" => $this->createUrl("/catalogmanager/"))
        );
    }

    public function actionIndex() {
        $model = new Catalog();
        $this->render('index', array('models' => $model->findAll()));
    }

    public function actionCreate() {
        $model = new Catalog();
        if (isset($_POST['Catalog'])) {
            $model->attributes = $_POST['Catalog'];
            if ($model->save())
                $this->redirect($this->createUrl("/catalogmanager/catalog/index"));
        }
        $this->render('create', array('model' => $model,));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        if (isset($_POST['Catalog'])) {
            $model->attributes = $_POST['Catalog'];
            if ($model->save())
                $this->redirect($this->createUrl("/catalogmanager/catalog/index"));
        }
        $this->render('update', array('model' => $model,));
    }

    public function actionDelete($id=false) {
        if ($id) {
            $model = $this->loadModel($id);
            $model->delete();
        } else if (!empty($_POST["catalog_id"])) {
            foreach ($_POST["catalog_id"] as $id) {
                $model = $this->loadModel($id);
                $model->delete();
            }
        }
        $this->redirect($this->createUrl("/catalogmanager/catalog/index"));
    }

}