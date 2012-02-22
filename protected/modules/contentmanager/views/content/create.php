<h1><?php echo Translater::getDictionary()->contentmanager_createTitle ?></h1>
<?php
$this->addBreadcrumb(array(array("name" => Translater::getDictionary()->contentmanager_createTitle, "action" => "")));
$this->renderPartial('_form', $form_array);
?>