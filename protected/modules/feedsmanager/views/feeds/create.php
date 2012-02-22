<h1><?php echo Translater::getDictionary()->feedsmanager_objectCreateTitleFeeds?></h1>
<?php
$this->addBreadcrumb(array(array("name"=>Translater::getDictionary()->feedsmanager_objectCreateTitleFeeds,"action"=>"")));
$this->renderPartial('_form', array('model'=>$model)); ?>