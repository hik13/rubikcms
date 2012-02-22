
<h1><?php echo Translater::getDictionary()->bannermanager_creatingTitle ?></h1>
<?php
$this->addBreadcrumb(array(
    array("name" => Translater::getDictionary()->bannermanager_creatingTitle, "action" => "")
));
$this->renderPartial('/banner/_form', $array);
?>