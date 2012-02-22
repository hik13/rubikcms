<?php
JsRegistry::getInstance()->setStatus("table-item-status", "rel", "/management/feedsmanager/feeds/setstatus/");
$blockButton = array(
    array("name" => Translater::getDictionary()->button_add, "class" => "green", "hidden" => false, "action" => $this->createUrl("/feedsmanager/feeds/create/"), "access" => $this->checkAccess("manageFeeds"), "onclick" => false),
    array("name" => Translater::getDictionary()->button_deleteSelected, "class" => "red", "action" => false, "access" => $this->checkAccess("manageFeeds"), "onclick" => "$('#feeds_form').submit()"),
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));


$tableheader = array(array('value' => "<input type='checkbox' id='checkall' onclick='checkitAll(this,\"table\")'>", 'class' => "table-cell-no-width thead-checkbox"),
    array('value' => Translater::getDictionary()->feedsmanager_tableNameFeed, 'class' => "thead-title", "sortable" => true),
    array('value' => Translater::getDictionary()->feedsmanager_tableStatus, 'class' => "table-cell-no-width"),
    array('value' => Translater::getDictionary()->feedsmanager_tableAction, 'class' => "thead-actions"),
);
$i = 0;

foreach ($feeds as $feed) {
    $tablecontent[$i]["cbox"] = CHtml::CheckBox("feed_id[" . $i . "]", false, array('value' => $feed->feed_id));
    $link = $this->createUrl("/feedsmanager/feedsobject/index/", array("id" => $feed->feed_id));
    $tablecontent[$i]["name"] = "<a href='$link'>" . $feed->feed_name . "</a>";
    $status["pict"] = $feed->feed_status == 1 ? "" : "unpublished";
    $status["title"] = $feed->feed_status == 1 ? Translater::getDictionary()->status_active : Translater::getDictionary()->status_notactive;
    $tablecontent[$i]["status"] = "<a rel='$feed->feed_id'  class='table-item-status " . $status["pict"] . "' title='" . $status["title"] . "'></a></td>";
    $arrayactions = array(array("class" => "table-action-add",
            "action" => $this->createUrl("/feedsmanager/feedsobject/create/", array("id" => $feed->feed_id)),
            "title" => Translater::getDictionary()->feedsmanager_buttonAddObjectToFeed,
            "onclick" => false,
            "access" => $this->checkAccess("manageFeedsObject")),
        array("class" => "table-action-edit",
            "action" => $this->createUrl("/feedsmanager/feeds/update/", array("id" => $feed->feed_id)),
            "title" => Translater::getDictionary()->button_edit,
            "onclick" => false,
            "access" => $this->checkAccess("manageFeeds")),
        array("class" => "table-action-delete",
            "action" => $this->createUrl("/feedsmanager/feeds/delete/", array("id" => $feed->feed_id)),
            "title" => Translater::getDictionary()->button_delete,
            "onclick" => 'return confirmdelete()',
            "access" => $this->checkAccess("manageFeeds")
        ),
    );
    $tablecontent[$i]["action"] = $this->renderPartial("//block/table/table_ul_button", array("actions" => $arrayactions), true, false);
    $i++;
}
?>

<form id="feeds_form" action="<?php echo $this->createUrl("/feedsmanager/feeds/delete/"); ?>" method="post">
<?php
if ($tablecontent)
    $this->renderPartial('//block/table/simple_table', array('header' => $tableheader, 'body' => $tablecontent, 'tclass' => "fedstable", "tid" => "no"));
?>
</form>

