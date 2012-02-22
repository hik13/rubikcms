<h1><?php echo Translater::getDictionary()->feedsmanager_objectUpdateTitle?></h1>
<?php  $this->addBreadcrumb(array(array("name"=>$feed->feed_name,"action"=>$this->createUrl("/feedsmanager/feedsobject/index/",array("id"=>$model->feed_id))),
                            array("name"=>Translater::getDictionary()->feedsmanager_objectUpdateTitle,"action"=>"")
                                 ));
$this->renderPartial('_form', array('model'=>$model,'feed'=>$feed)); ?>