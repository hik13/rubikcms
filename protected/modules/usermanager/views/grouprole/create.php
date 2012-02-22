<h1><?php echo Translater::getDictionary()->groupmanager_createTitle ?></h1>
<?php 
$this->addBreadcrumb(array(
                           array("name"=>Translater::getDictionary()->groupmanager_createTitle,"action"=>"")
                           ));
$this->renderPartial('_form', array('model'=>$model,'permission'=>$permission));
?>