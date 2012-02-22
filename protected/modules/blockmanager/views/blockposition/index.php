<?php
$blockButton = array(
    array("name" => Translater::getDictionary()->button_add, "class" => "green", "hidden" => false, "action" => $this->createUrl("/blockmanager/blockposition/create/"), "access" => $this->checkAccess("managePosition"), "onclick" => false)
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));

$tableheader = array(
    array('value' => "#", 'class' => "table-cell-no-width thead-number", "sortable" => true, "sort_now" => true),
    array('value' => Translater::getDictionary()->blockposition_tableKeyPosition, 'class' => "thead-title", "sortable" => false),
    array('value' => Translater::getDictionary()->blockposition_tableDeskPosition, 'class' => "thead-description", "sortable" => false),
    array('value' => Translater::getDictionary()->blockposition_tableActionPosition, 'class' => "thead-actions", "sortable" => false),
);


$i = 0;
foreach ($models as $model) {
    $tablecontent[$i]["index"] = $i + 1;
    $tablecontent[$i]["key"] = $model->position_code;
    $tablecontent[$i]["desk"] = $model->position_desk;
    $arrayactions = array(array("class" => "table-action-edit",
            "action" => $this->createUrl("/blockmanager/blockposition/update/", array("id" => $model->position_id)),
            "title" => Translater::getDictionary()->button_edit,
            "onclick" => false,
            "access" => $this->checkAccess("managePosition")),
        array("class" => "table-action-delete",
            "action" => $this->createUrl("/blockmanager/blockposition/delete/", array("id" => $model->position_id)),
            "title" => Translater::getDictionary()->button_delete,
            "onclick" => 'return confirmdelete()',
            "access" => $this->checkAccess("managePosition")
        ),
    );
    $tablecontent[$i]["action"] = $this->renderPartial("//block/table/table_ul_button", array("actions" => $arrayactions), true, false);
    $i++;
}
?>

<form id="position_form" action="<?php echo $this->createUrl("/blockmanager/blockposition/delete/") ?>" method="post">
    <?php $this->renderPartial('//block/table/simple_table', array('header' => $tableheader, 'body' => $tablecontent, 'tclass' => "positiontable", "tid" => "no")); ?>
</form>
