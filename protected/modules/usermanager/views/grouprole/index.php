<?php
$blockButton = array(
    array("name" => Translater::getDictionary()->button_add, "class" => "green", "hidden" => false, "action" => $this->createUrl("/usermanager/grouprole/create/"), 'access' =>$this->checkAccess("manageGroupRole"), "onclick" => false),
    array("name" => Translater::getDictionary()->button_deleteSelected, "class" => "red", "hidden" => false, "action" => false, "access" => $this->checkAccess("manageGroupRole"), "onclick" => "$('#group_form').submit()"),
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));

$tableheader = array(
    array('value' => "<input type='checkbox' id='checkall' onclick='checkitAll(this,\"table\")'>", 'class' => "table-cell-no-width thead-checkbox"),
    array('value' => "#", 'class' => "table-cell-no-width thead-number", "sortable" => true, "sort_now" => true),
    array('value' => Translater::getDictionary()->groupmanager_tableNameGroup, 'class' => "thead-title", "sortable" => true),
    array('value' => Translater::getDictionary()->groupmanager_tableAction, 'class' => "thead-actions"),
);


$i = 0;
foreach ($groups as $group) {
    $tablecontent[$i]["cbox"] = CHtml::CheckBox("group_role_id[" . $i . "]", false, array('value' => $group->group_role_id));
    $tablecontent[$i]["index"] = $i + 1;
    $tablecontent[$i]["name"] = $group->group_role_name;
    $arrayactions = array(
        array("class" => "table-action-edit",
            "action" => $this->createUrl("/usermanager/grouprole/update/", array("id" => $group->group_role_id)),
            "title" => Translater::getDictionary()->button_edit,
            "onclick" => false,
            "access" => $this->checkAccess("manageGroupRole")
        ),
        array("class" => "table-action-delete",
            "action" => $this->createUrl("/usermanager/grouprole/delete/", array("id" => $group->group_role_id)),
            "title" => Translater::getDictionary()->button_delete,
            "onclick" => 'return confirmdelete()',
            "access" => $this->checkAccess("manageGroupRole")
        ),
    );
    $tablecontent[$i]["action"] = $this->renderPartial("//block/table/table_ul_button", array("actions" => $arrayactions), true, false);
    $i++;
}
?>
<form id="group_form" action="<?php echo $this->createUrl("/usermanager/grouprole/delete/") ?>" method="post">
    <?php
     $this->renderPartial('//block/table/simple_table', array('header' => $tableheader,'body' => $tablecontent, 'tclass' => "grouptable", "tid" =>"no"));
    ?>
</form>
