<h1><?php echo Translater::getDictionary()->catalogmanager_catalogCreateDimensionTitle?></h1>
<?php
$this->addBreadcrumb(array( array("name"=>$modelgroup->dimension_group_name,"action"=>$this->createUrl("/catalogmanager/dimension/view/",array("id"=>$modelgroup->dimension_group_id))),
                            array("name"=>Translater::getDictionary()->catalogmanager_catalogCreateDimensionTitle,"action"=>"")));

$this->renderPartial('_formdimension', array('model'=>$model));
?>
