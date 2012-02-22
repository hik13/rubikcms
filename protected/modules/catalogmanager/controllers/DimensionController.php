<?php

class DimensionController extends BackController {

     public function init() {
        parent::init();
        $this->breadcrumb=array(
                array("name"=>Translater::getDictionary()->catalogmanager_CatalogName,"action"=>$this->createUrl("/catalogmanager/")),
                array("name"=>Translater::getDictionary()->catalogmanager_DimensionName,"action"=>$this->createUrl("/catalogmanager/dimension/")),
        );
    }



    public function filters() {
        return array(
               'ManageDimension + create,update,delete,dimensioncreate,dimensionupdate,dimensiondelete',
        );
    }

   public function filterManageDimension($filterChain) {
       if ($this->checkAccess("manageDimension")) {
        $filterChain->run();
       } else {
          throw new CHttpException(404,'The requested page does not exist.');
       }
    }

    public function actionIndex() {
        $model = new DimensionGroup();
        $models=$model->findAll();
        if (isset($_GET["modal"])) {
            $this->renderPartial('modal/index', array('models' =>$models ));
        } else
            $this->render('index', array('models' => $models));
    }

    public function actionCreate() {
        $model = new DimensionGroup();
        if (isset($_POST["modal"])) {
            $model->attributes = $_POST['DimensionGroup'];
            if ($model->save()) {
                $this->renderPartial('modal/index_group', array('model' => $model));
            }
        } else {
            if (isset($_POST['DimensionGroup'])) {
                $model->attributes = $_POST['DimensionGroup'];
                if ($model->save())
                    $this->redirect("/catalog/dimension/");
            }
            $this->render('create', array('model' => $model,));
        }
    }


    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        if (isset($_POST["modal"])) {
            $model->attributes = $_POST['DimensionGroup'];
            if ($model->save()) {
                $this->renderPartial('modal/index_group', array('model' => $model,"class"=>"active-unit"));
            }
        } else {
            if (isset($_POST['DimensionGroup'])) {
                $model->attributes = $_POST['DimensionGroup'];
                if ($model->save())
                    $this->redirect("/catalog/dimension/");
            }
            $this->render('update', array(
                'model' => $model,
            ));
        }
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();
        if (isset($_POST["modal"])) {
            exit;
        } else {
            $this->redirect(array('/catalog/dimension/'));
        }
    }

     public function actionView($id) {
        $model = $this->loadModel($id);
        if (isset($_POST["modal"])) {
            $this->renderPartial('modal/index_dimension', array('dimensions' => $model->units));
        } else {
            $this->render('view', array("model" => $model, 'dimensions' => $model->units));
        }
    }


    public function loadModel($id) {
        $model=DimensionGroup::model()->findByPk((int)$id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }



    public function actionDimensioncreate($id) {
        $modelgroup = $this->loadModel($id);
        $model = new Dimension();
        if ($_POST["modal"]) {
            if (isset($_POST['Dimension'])) {
                $model->attributes = $_POST['Dimension'];
                if ($model->save()) {
                    $this->renderPartial('modal/index_dimension', array('dimensions' => $modelgroup->units));
                }
            } else {
                $model->dimension_group_id = $id;
                $this->renderPartial('modal/modal_demension_form', array('model' => $model));
            }
        } else {
            $model->dimension_group_id = $id;
            if (isset($_POST['Dimension'])) {
                $model->attributes = $_POST['Dimension'];
                if ($model->save())
                    $this->redirect("/catalog/dimension/view/id/$model->dimension_group_id");
            }
            $this->render('createdimension', array('model' => $model, "modelgroup" => $modelgroup));
        }
    }

    public function actionDimensionupdate($id) {
        $model = new Dimension();
        $model = $model->findByPk((int) $id);
        $modelgroup = $this->loadModel($model->dimension_group_id);
        if ($_POST["modal"]) {
            if (isset($_POST['Dimension'])) {
                $model->attributes = $_POST['Dimension'];
                if ($model->save()) {
                    $this->renderPartial('modal/index_dimension', array('dimensions' => $modelgroup->units));
                }
            } else {
                $this->renderPartial('modal/modal_demension_form', array('model' => $model));
            }
        } else {
            if (isset($_POST['Dimension'])) {
                $model->attributes = $_POST['Dimension'];
                if ($model->save())
                    $this->redirect("/catalog/dimension/view/id/$model->dimension_group_id");
            }
            $this->render('updatedimension', array('model' => $model, "modelgroup" => $modelgroup));
        }
    }

    public function actionDimensiondelete($id) {
        $model = new Dimension();
        $model = $model->findByPk((int) $id);
        $group_id = $model->dimension_group_id;
        $model->delete();
        if (isset($_POST["modal"])) {
            exit;
        } else {
            $this->redirect("/catalog/dimension/view/id/$group_id");
        }
    }



    
}