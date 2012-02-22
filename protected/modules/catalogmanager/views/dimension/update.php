<h1><?php echo Translater::getDictionary()->catalogmanager_catalogEditDimensionGroupTitle?></h1>
<?php

$this->addBreadcrumb(array(
    array("name"=>$model->dimension_group_name,"action"=>$this->createUrl("/catalogmanager/dimension/view/",array("id"=>$model->dimension_group_id))),
    array("name"=>Translater::getDictionary()->catalogmanager_catalogEditDimensionGroupTitle,"action"=>"")));

$this->renderPartial('_form', array('model'=>$model));
?>