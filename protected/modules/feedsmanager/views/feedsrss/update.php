<h1><?php echo Translater::getDictionary()->feedsmanager_objectUpdateTitleFeeds?></h1>
<?php
$this->addBreadcrumb(array(array("name"=>Translater::getDictionary()->feedsmanager_objectUpdateTitleFeeds,"action"=>"")));
$this->renderPartial('_form', array('model'=>$model,"list"=>$list)); ?>