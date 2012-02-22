<?php

class ManufacturerController extends BackController {

     protected $basicRigth="manageManufacturer";
 
     public function init() {
        parent::init();
        $this->breadcrumb=array(
                array("name"=>Translater::getDictionary()->catalogmanager_CatalogName,"action"=>$this->createUrl("/catalogmanager/")),
                array("name"=>Translater::getDictionary()->catalogmanager_ManufacturerName,"action"=>$this->createUrl("/catalogmanager/manufacturer/")),
        );
    }

    public function actionIndex() {
        $letter=empty($_GET['letter'])?"digit":$_GET['letter'];
        $array= Manufacturer::model()->getByLetter($letter);
        $this->render('index',array('array'=>$array,"letter"=>$letter));
    }

    public function actionCreate() {
        $model=new Manufacturer();
        if(isset($_POST['Manufacturer'])) {
            $model->attributes=$_POST['Manufacturer'];
            if($model->save())
                $this->redirect($this->createUrl("/catalogmanager/manufacturer/index/",array("letter"=>$model->manufacturer_letter)));
        }
        $this->render('create',array('model'=>$model,));
    }
   
    public function actionUpdate($id) {
        $model=$this->loadModel($id);
        if(isset($_POST['Manufacturer'])) {
            $model->attributes=$_POST['Manufacturer'];
            if($model->save())
                $this->redirect($this->createUrl("/catalogmanager/manufacturer/index/",array("letter"=>$model->manufacturer_letter)));
        }
        $this->render('update',array( 'model'=>$model,));
    }
    
    public function actionDelete($id) {
        $this->loadModel($id)->delete();
        $this->redirect($this->createUrl("/catalogmanager/manufacturer/"));
    }

    public function actionSuggest($str) {
        if ($str) {
            $array = Manufacturer::model()->getSuggest($str);
            ResponseAjax::setResponseText($this->renderPartial('suggestregion', array('suggests' => $array,), true));
        }
        echo ResponseAjax::jsonRspObj();
    }
   

}