<h1><?php echo Translater::getDictionary()->catalogmanager_catalogEditCategoryTitle ?></h1>
<?php
$this->addBreadcrumb(array(array("name"=>Translater::getDictionary()->catalogmanager_catalogEditCategoryTitle,"action"=>"")));
$this->renderPartial('/category/_form', array('model'=>$model));
?>