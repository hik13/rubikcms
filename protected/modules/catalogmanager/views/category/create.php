<h1><?php echo Translater::getDictionary()->catalogmanager_catalogCreateCategoryTitle ?></h1>
<?php
$this->addBreadcrumb(array(array("name"=>Translater::getDictionary()->catalogmanager_catalogCreateCategoryTitle,"action"=>"")));
$this->renderPartial('/category/_form', array('model'=>$model));
?>