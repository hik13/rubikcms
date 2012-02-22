<h1><?php echo Translater::getDictionary()->bannermanager_editingTitle ?></h1>
<?php
$this->addBreadcrumb(array(
    array("name" => Translater::getDictionary()->bannermanager_editingTitle, "action" => "")
));
$this->renderPartial('/banner/_form', $array);
?>