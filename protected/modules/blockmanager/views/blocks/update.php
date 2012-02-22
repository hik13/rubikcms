<h1><?php echo Translater::getDictionary()->blockmanager_editTitle ?></h1>
<?php
$this->addBreadcrumb(array(
    array("name" => Translater::getDictionary()->blockmanager_editTitle, "action" => "")
));
$this->renderPartial('/blocks/_form', $array);
?>