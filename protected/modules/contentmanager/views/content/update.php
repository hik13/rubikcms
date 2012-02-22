<h1><?php echo Translater::getDictionary()->contentmanager_updateTitle ?></h1>
<?php
$this->addBreadcrumb(array(array("name" => Translater::getDictionary()->contentmanager_updateTitle, "action" => "")));
$this->renderPartial('_form',$form_array);
?>