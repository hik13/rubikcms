<h1><?php echo Translater::getDictionary()->catalogmanager_catalogEditEssenceTitle ?></h1>
<?php
$this->addBreadcrumb(array(array("name"=>Translater::getDictionary()->catalogmanager_catalogEditEssenceTitle,"action"=>"")));
$this->renderPartial('/essence/_form', array('model'=>$model));
?>