<h1><?php echo Translater::getDictionary()->catalogmanager_catalogEditManufacturerTitle  ?></h1>
<?php
$this->addBreadcrumb(array(array("name"=>Translater::getDictionary()->catalogmanager_catalogEditManufacturerTitle ,"action"=>"")));
$this->renderPartial('_form', array('model'=>$model));
?>