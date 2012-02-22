<?php
JsRegistry::getInstance()->setStatus("table-item-status","id","/management/usermanager/user/setstatus/");
$blockButton = array(
    array("name" => Translater::getDictionary()->button_add, "class" => "green", "hidden" => false, "action" => $this->createUrl("/usermanager/user/create/"), 'access' => $this->checkAccess("manageUser"), "onclick" => false),
    array("name" => Translater::getDictionary()->button_deleteSelected, "class" => "red", "hidden" => false, "action" => false, "access" => $this->checkAccess("manageUser"), "onclick" => "$('#users_form').submit()"),
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));


$tableheader = array(
    array('value' => "<input type='checkbox' id='checkall' onclick='checkitAll(this,\"table\")'>", 'class' => "table-cell-no-width thead-checkbox"),
    array('value' => "#", 'class' => "table-cell-no-width thead-number", "sortable" => true, "sort_now" => true),
    array('value' => Translater::getDictionary()->usermanager_tableNameUser, 'class' => "thead-title", "sortable" => true),
    array('value' => Translater::getDictionary()->usermanager_tableTypeUser, 'class' => "thead-status", "sortable" => true),
    array('value' => Translater::getDictionary()->usermanager_tableStatusUser, 'class' => "table-cell-no-width",),
    array('value' => Translater::getDictionary()->usermanager_tableAction, 'class' => "thead-status"),
);



$i = 0;
foreach ($users as $user) {
    $tablecontent[$i]["cbox"] = CHtml::CheckBox("user_id[" . $i . "]", false, array('value' => $user->user_id));
    $tablecontent[$i]["index"] = $i + 1;
    $tablecontent[$i]["name"] = $user->name;
    $tablecontent[$i]["role"] = $role[$user->group_role_id];
    $status["pict"] = $user->user_status == 1 ? "" : "unpublished";
    $status["title"] = $user->user_status == 1 ? Translater::getDictionary()->status_active : Translater::getDictionary()->status_notactive;
    $tablecontent[$i]["status"] = "<a id='$user->user_id' class='table-item-status " . $status["pict"] . "' title='" . $status["title"] . "'></a></td>";
    $arrayactions = array(
        array("class" => "table-action-edit",
            "action" => $this->createUrl("/usermanager/user/update/", array("id" => $user->user_id)),
            "title" => Translater::getDictionary()->button_edit,
            "onclick" => false,
            "access" => $this->checkAccess("manageUser")
        ),
        array("class" => "table-action-delete",
            "action" => $this->createUrl("/usermanager/user/delete/", array("id" => $user->user_id)),
            "title" => Translater::getDictionary()->button_delete,
            "onclick" => 'return confirmdelete()',
            "access" => $this->checkAccess("manageUser")
        ),
    );
    $tablecontent[$i]["action"] = $this->renderPartial("//block/table/table_ul_button", array("actions" => $arrayactions), true, false);
    $i++;
}
?>

<form id="users_form" action="<?php echo $this->createUrl("/usermanager/user/delete/") ?>" method="post">
<?php  $this->renderPartial('//block/table/simple_table', array('header' => $tableheader,'body' => $tablecontent, 'tclass' => "usertable", "tid" =>"no"));
?>
</form>

