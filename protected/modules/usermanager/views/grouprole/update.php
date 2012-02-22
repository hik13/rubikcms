<h1><?php echo Translater::getDictionary()->groupmanager_updateTitle ?></h1>
<?php
$this->addBreadcrumb(array(array("name"=>Translater::getDictionary()->groupmanager_updateTitle,"action"=>"")));
$this->renderPartial('_form', array('model'=>$model,'permission'=>$permission));
?>