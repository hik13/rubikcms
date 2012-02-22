<h1><?php echo Translater::getDictionary()->usermanager_updateTitle ?></h1>
<?php
$this->addBreadcrumb(array(array("name"=>Translater::getDictionary()->usermanager_updateTitle,"action"=>"")));
$this->renderPartial('_form', array('model'=>$model,"role"=>$role));
 ?>