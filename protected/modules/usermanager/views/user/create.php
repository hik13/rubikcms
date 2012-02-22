<h1><?php echo Translater::getDictionary()->usermanager_createTitle ?></h1>
<?php
$this->addBreadcrumb(array(array("name" => Translater::getDictionary()->usermanager_createTitle, "action" => "")));
$this->renderPartial('_form', array('model' => $model, "role" => $role));
?>