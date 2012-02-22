<h1><?php echo Translater::getDictionary()->catalogmanager_catalogEditItemTitle ?></h1>
<?php
$this->addBreadcrumb(array(array("name"=>Translater::getDictionary()->catalogmanager_catalogEditItemTitle,"action"=>"")));
$this->renderPartial('/item/_form', array('model'=>$model));
?>