<h1><?php echo Translater::getDictionary()->catalogmanager_catalogCreateTitle ?></h1>
<?php 
$this->addBreadcrumb(array(array("name"=>Translater::getDictionary()->catalogmanager_catalogCreateTitle,"action"=>"")));
$this->renderPartial('_form', array('model'=>$model));
?>