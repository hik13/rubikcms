<?php
 $blockButton = array(
    array("name" => Translater::getDictionary()->catalogmanager_buttonAddDimensionGroup, "class"=>"green","hidden" => false,"action"=>$this->createUrl("/catalogmanager/dimension/create/"), "access"=>$this->checkAccess("manageDimension"),"onclick" => false),
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));


$tableheader=array(array('value'=>"<input type='checkbox' id='checkall' onclick='checkitAll(this,\"table\")'>",'class'=>"table-cell-no-width thead-checkbox"),
                   array('value'=>Translater::getDictionary()->catalogmanager_tableNameDimensionGroup,'class'=>"thead-title","sortable"=>true),
                   array('value'=>Translater::getDictionary()->catalogmanager_tableActionCatalog,'class'=>"thead-actions"),
);
$i=0;
if (!empty ($models)) {
foreach($models as $group) {
$tablecontent[$i]["cbox"]=CHtml::CheckBox("dimension_group_id[".$i."]",false, array('value'=>$group->dimension_group_id));
$tablecontent[$i]["name"]="<a href='".$this->createUrl("/catalogmanager/dimension/view/",array("id"=>$group->dimension_group_id))."'>".$group->dimension_group_name."</a>";
$arrayactions=array (array("class"=>"table-action-edit",
                           "action"=>$this->createUrl("/catalogmanager/dimension/dimensioncreate/",array("id"=>$group->dimension_group_id)),
                           "title"=>Translater::getDictionary()->catalogmanager_buttonAddDimension,
                           "onclick"=>false,
                           "access"=>$this->checkAccess("manageDimension")),
                     array("class"=>"table-action-edit",
                           "action"=>$this->createUrl("/catalogmanager/dimension/update/",array("id"=>$group->dimension_group_id)),
                           "title"=>Translater::getDictionary()->button_edit,
                           "onclick"=>false,
                           "access"=>$this->checkAccess("manageDimension")),
                     array("class"=>"table-action-delete",
                           "action"=>$this->createUrl("/catalogmanager/dimension/delete/",array("id"=>$group->dimension_group_id)),
                           "title"=>Translater::getDictionary()->button_delete,
                           "onclick"=>'return confirmdelete()',
                           "access"=>$this->checkAccess("manageDimension")
                         ),
                     );
$tablecontent[$i]["action"]=$this->renderPartial("//block/table/table_ul_button", array("actions" => $arrayactions), true, false);
$i++;
} 
}


?>
<h1> <?php echo Translater::getDictionary()->catalogmanager_Dimension ?></h1>

<form id="dimension_form" action="<?php echo $this->createUrl("/catalogmanager/dimension/savetreechange/")?>" method="post">
 <?php 
 $this->renderPartial('//block/table/simple_table', array('header' => $tableheader,'body' => $tablecontent, 'tclass' => "dimensiontable", "tid" =>"no"));
?>

</form>



