<h1><?php echo Translater::getDictionary()->localemanager_createTitle ?></h1>
<?php
$this->addBreadcrumb(array(
    array("name" => Translater::getDictionary()->localemanager_createTitle, "action" => "")
));
$this->renderPartial('_form', array('model' => $model));
?>