<?php 
JsRegistry::getInstance()->sortTable("objectstable", "object_order", "object_order", "simple-button"); 
JsRegistry::getInstance()->setStatus("table-item-status", "rel", "/management/feedsmanager/feedsobject/setstatus/");
?>
<h1><?php echo Translater::getDictionary()->feed_contents?></h1>
<?php
$this->addBreadcrumb(array(array("name"=>$feed->feed_name,"action"=>"")));


$blockButton = array(
    array("name" => Translater::getDictionary()->button_add, "class"=>"green","hidden" => false,"action"=>$this->createUrl("/feedsmanager/feedsobject/create/",array("id"=>$feed->feed_id)), "access"=>$this->checkAccess("manageFeedsObject"),"onclick" => false),
    array("name"=>Translater::getDictionary()->button_deleteSelected, "class"=>"red","hidden" => false, "action" =>false, "access" => $this->checkAccess("manageFeedsObject"), "onclick" => "$('#feedobjects_form').submit()"),
    array("name" => Translater::getDictionary()->button_save, "class" => "", "hidden" => true, "action" => false, 'access' => $this->checkAccess("manageFeedsObject"), "onclick" => "$('#feedobjects_form').submit()"),
    array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "hidden" => true, "action" => $this->createUrl("/feedsmanager/feedsobject/index",array("id"=>$feed->feed_id)), "access" => $this->checkAccess("manageFeedsObject"), "onclick" => false),
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));




$tableheader=array(array('value'=>"<input type='checkbox' id='checkall' onclick='checkitAll(this,\"table\")'>",'class'=>"table-cell-no-width thead-checkbox"),
        array('value'=>"#",'class'=>"table-cell-no-width thead-number","sortable"=>true,"sort_now"=>true),
        array('value' => "", 'class' => "table-cell-no-width empty-cell"),
        array('value'=>Translater::getDictionary()->feedsmanager_tableNameFeedsobject,'class'=>"thead-title","sortable"=>true),
        array('value'=>Translater::getDictionary()->feedsmanager_tableDateFeedsobject,'class'=>"thead-title","sortable"=>true),
        array('value'=>Translater::getDictionary()->feedsmanager_tableStatus, 'class' => "table-cell-no-width"),    
        array('value'=>Translater::getDictionary()->feedsmanager_tableAction,'class'=>"thead-actions",),
);
$i=0;
foreach($feedobjects as $object) {
$tablecontent[$object->feed_object_id]["cbox"]=CHtml::CheckBox("delete_feed_object_id[".$i."]",false, array('value'=>$object->feed_object_id));
$tablecontent[$object->feed_object_id]["index"]=$i+1;
$tablecontent[$object->feed_object_id]["sort"] = array("sortable" => true);
$link=$this->createUrl("/feedsmanager/feedsobject/view/",array("id"=>$object->feed_object_id));
$tablecontent[$object->feed_object_id]["name"]="<a href='$link'>".$object->feed_object_name.'</a>';
$tablecontent[$object->feed_object_id]["date"]=Time::getDateTime($object->created>$object->edition?$object->created:$object->edition);
$status["pict"] = $object->status_id == 1 ? "" : "unpublished";
$status["title"] = $object->status_id == 1 ? Translater::getDictionary()->status_active : Translater::getDictionary()->status_notactive;
$tablecontent[$object->feed_object_id]["status"] = "<a rel='$object->feed_object_id'  class='table-item-status " . $status["pict"] . "' title='" . $status["title"] . "'></a></td>";
$arrayactions=array (array("class"=>"table-action-edit",
                           "action"=>$this->createUrl("/feedsmanager/feedsobject/update/",array("id"=>$object->feed_object_id)),
                           "title"=>Translater::getDictionary()->button_edit,
                           "onclick"=>false,
                           "access"=>$this->checkAccess("manageFeedsObject")),
                     array("class"=>"table-action-delete",
                           "action"=>$this->createUrl("/feedsmanager/feedsobject/delete/",array("id"=>$object->feed_object_id)),
                           "title"=>Translater::getDictionary()->button_delete,
                           "onclick"=>'return confirmdelete()',
                           "access"=>$this->checkAccess("manageFeedsObject")
                         ),
                     );
$tablecontent[$object->feed_object_id]["action"]=$this->renderPartial("//block/table/table_ul_button", array("actions" => $arrayactions), true, false);
$i++;}
?>

<form id="feedobjects_form" action="<?php  echo $this->createUrl("/feedsmanager/feedsobject/savechange/"); ?>" method="post">    
<?php 
$this->renderPartial('//block/table/simple_table', array('header' => $tableheader,'body' => $tablecontent, 'tclass' => "objectstable", "tid" =>"no"));
?>
</form>
