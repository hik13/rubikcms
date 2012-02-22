<?php 
$blockButton = array(
 array("name" => Translater::getDictionary()->catalogmanager_buttonAddDimension, "class" => "green", "hidden" => false, "action" =>$this->createUrl("/catalogmanager/dimension/dimensioncreate/",array("id"=>$model->dimension_group_id)), "access" => $this->checkAccess("manageDimension"), "onclick" => false),
 array("name" => Translater::getDictionary()->button_edit, "class" => "", "hidden" => false, "action" =>$this->createUrl("/catalogmanager/dimension/update/",array("id"=>$model->dimension_group_id)), "access" => $this->checkAccess("manageDimension"), "onclick" => false),
 array("name" => Translater::getDictionary()->button_delete, "class" => "red", "hidden" => false, "action" =>$this->createUrl("/catalogmanager/dimension/delete/",array("id"=>$model->dimension_group_id)), "access" => $this->checkAccess("manageDimension"), "onclick" => false),
        );
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));


$breadcrubs=array(  array("name"=>$model->dimension_group_name,"action"=>"/catalog/dimension/view/id/$model->dimension_group_id"),);
$this->addBreadcrumb($breadcrubs);


$tableheader=array(array('value'=>"<input type='checkbox' id='checkall' onclick='checkitAll(this,\"table\")'>",'class'=>"table-cell-no-width"),
                   array('value'=>Translater::getDictionary()->catalogmanager_tableDimensionName,'class'=>"","sortable"=>true),
                   array('value'=>Translater::getDictionary()->catalogmanager_tableActionCatalog,'class'=>""),
);
$i=0;
if (!empty ($dimensions)) {
foreach($dimensions as $dimension) {
$tablecontent[$i]["cbox"]=CHtml::CheckBox("dimension_id[".$i."]",false, array('value'=>$dimension->dimension_id));
$tablecontent[$i]["name"]="<a href='".$this->createUrl("/catalogmanager/dimension/dimensionupdate/",array("id"=>$dimension->dimension_id))."'>".$dimension->dimension_name."</a>";
$arrayactions=array (
                     array("class"=>"table-action-edit",
                           "action"=>$this->createUrl("/catalogmanager/dimension/dimensionupdate/",array("id"=>$dimension->dimension_id)),
                           "title"=>Translater::getDictionary()->button_edit,
                           "onclick"=>false,
                           "access"=>$this->checkAccess("manageDimension")),
                     array("class"=>"table-action-delete",
                           "action"=>$this->createUrl("/catalogmanager/dimension/dimensiondelete/",array("id"=>$dimension->dimension_id)),
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
<h1> <?php echo $model->dimension_group_name;?></h1>

<form id="content_form" action="<?php echo $this->createUrl("/catalogmanager/dimension/dimensionsavetreechange/") ?>" method="post">
 <?php
    $this->renderPartial('//block/table/simple_table', array('header' => $tableheader,'body' => $tablecontent, 'tclass' => "dimgrouptable", "tid" =>"no"));
?>
</form>

