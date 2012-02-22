<h1><?php echo Translater::getDictionary()->catalogmanager_catalogCreateEssenceTitle ?></h1>
<?php
$this->addBreadcrumb(array(array("name"=>Translater::getDictionary()->catalogmanager_catalogCreateEssenceTitle,"action"=>"")));
$this->renderPartial('/essence/_form', array('model'=>$model));
?>