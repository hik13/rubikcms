<h1><?php echo Translater::getDictionary()->catalogmanager_catalogCreateManufacturerTitle ?></h1>
<?php
$this->addBreadcrumb(array(array("name"=>Translater::getDictionary()->catalogmanager_catalogCreateManufacturerTitle,"action"=>"")));
$this->renderPartial('_form', array('model'=>$model));
?>