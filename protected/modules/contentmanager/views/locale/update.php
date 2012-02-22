<h1><?php echo Translater::getDictionary()->localemanager_updateTitle ?></h1>
<?php
$this->addBreadcrumb(array(array("name" => Translater::getDictionary()->localemanager_updateTitle, "action" => "")));
$this->renderPartial('_form', array('model' => $model));
?>