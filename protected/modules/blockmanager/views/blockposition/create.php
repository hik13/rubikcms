<h1><?php echo Translater::getDictionary()->blockposition_createTitle ?></h1>
<?php
$this->addBreadcrumb(array(
    array("name" => Translater::getDictionary()->blockposition_createTitle, "action" => "")
));
$this->renderPartial('_form', array('model' => $model));
?>