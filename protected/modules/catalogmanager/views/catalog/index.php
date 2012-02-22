
<?php
$blockButton = array(
    array("name" => Translater::getDictionary()->button_add, "class"=>"green","hidden" => false,"action"=> $this->createUrl("/catalogmanager/catalog/create/"), "access"=>$this->checkAccess("manageObject"),"onclick" => false),
    array("name" => Translater::getDictionary()->button_delete, "class"=>"red","hidden" => false,"action"=> false, "access"=>$this->checkAccess("manageObject"),"onclick" => "$('#catalog_form').submit()"),
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));


$tableheader = array(array('value' => "<input type='checkbox' id='checkall' onclick='checkitAll(this,\"table\")'>", 'class' => "table-cell-no-width thead-checkbox"),
    array('value' => Translater::getDictionary()->catalogmanager_tableNameCatalog, 'class' => "thead-title", "sortable" => true),
    array('value' => Translater::getDictionary()->catalogmanager_tableActionCatalog, 'class' => "thead-actions"),
);



$i = 0;
if (!empty($models)) {
    foreach ($models as $model) {
        $tablecontent[$i]["cbox"] = CHtml::CheckBox("catalog_id[" . $i . "]", false, array('value' => $model->catalog_id));
        $link = $this->createUrl("/catalogmanager/object/index/", array("catalog" => $model->catalog_id));
        $tablecontent[$i]["name"] = "<a href='$link'>" . $model->catalog_name . "</a>";
        $arrayactions = array(
            array("class" => "table-action-edit",
                "action" => $this->createUrl("/catalogmanager/catalog/update/", array("id" => $model->catalog_id)),
                "title" => Translater::getDictionary()->button_edit,
                "onclick" => false,
                "access" => $this->checkAccess("manageObject")),
            array("class" => "table-action-delete",
                "action" => $this->createUrl("/catalogmanager/catalog/delete/", array("id" => $model->catalog_id)),
                "title" => Translater::getDictionary()->button_delete,
                "onclick" => 'return confirmdelete()',
                "access" => $this->checkAccess("manageObject"),
            ),
        );
        $tablecontent[$i]["action"] = $this->renderPartial("//block/table/table_ul_button", array("actions" => $arrayactions), true, false);
        $i++;
    }
}
?>

<form id="catalog_form" action="<?php echo $this->createUrl("/catalogmanager/catalog/delete/"); ?>" method="post">
    <?php
   $this->renderPartial('//block/table/simple_table', array('header' => $tableheader,'body' => $tablecontent, 'tclass' => "catalogtable", "tid" =>"no"));
    ?>
</form>