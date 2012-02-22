<h1><?php echo Translater::getDictionary()->catalogmanager_catalogCreateDimensionGroupTitle?></h1>
<?php
$this->addBreadcrumb(array(array("name"=>Translater::getDictionary()->catalogmanager_catalogCreateDimensionGroupTitle,"action"=>"")));
$this->renderPartial('_form', array('model'=>$model));
?>