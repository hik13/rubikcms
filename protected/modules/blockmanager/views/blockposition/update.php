<h1><?php echo Translater::getDictionary()->blockposition_editTitle ?></h1>
<?php
$this->addBreadcrumb(array(array("name" => Translater::getDictionary()->blockposition_editTitle, "action" => "")));
$this->renderPartial('_form', array('model' => $model));
?>