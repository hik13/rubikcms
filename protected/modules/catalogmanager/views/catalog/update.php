<h1><?php echo Translater::getDictionary()->catalogmanager_catalogUpdateTitle ?></h1>
<?php
$this->addBreadcrumb(array(array("name"=>Translater::getDictionary()->catalogmanager_catalogUpdateTitle,"action"=>"")));
$this->renderPartial('_form', array('model'=>$model));
?>