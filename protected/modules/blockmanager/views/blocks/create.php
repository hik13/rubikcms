<h1><?php echo Translater::getDictionary()->blockmanager_createTitle ?></h1>
<?php
$this->addBreadcrumb(array(
    array("name" => Translater::getDictionary()->blockmanager_createTitle, "action" => "")
));
$this->renderPartial('/blocks/_form', $array);
?>
