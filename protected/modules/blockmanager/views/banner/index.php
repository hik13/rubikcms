<?php
JsRegistry::getInstance()->sortTable("bannertable", "banner_order", "banner_order", "simple-button");
JsRegistry::getInstance()->setStatus("table-item-status", "rel", "/management/blockmanager/banner/setstatus/");
$blockButton = array(
    array("name" => Translater::getDictionary()->button_add, "class" => "green", "hidden" => false, "action" => $this->createUrl("/blockmanager/banner/create/"), 'access' => $this->checkAccess("manageBanner"), "onclick" => false),
    array("name" => Translater::getDictionary()->button_save, "class" => "red", "hidden" => true, "action" => false, "access" => $this->checkAccess("manageBanner"), "onclick" => "$('#banner_form').submit();",),
    array("name" => Translater::getDictionary()->button_cansel, "class" => "", "hidden" => true, "action" => $this->createUrl("/blockmanager/banner/"), "access" => $this->checkAccess("manageBanner"), "onclick" => false),
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));

$tableheader = array(
    array('value' => "#", 'class' => "table-cell-no-width thead-number"),
    array('value' => "", 'class' => "table-cell-no-width empty-cell"),
    array('value' => Translater::getDictionary()->bannermanager_tableNameBanner, 'class' => "thead-title"),
    array('value' => Translater::getDictionary()->bannermanager_tableDeskBanner, 'class' => "thead-description"),
    array('value' => Translater::getDictionary()->bannermanager_tableStatus, 'class' => "table-cell-no-width"),
    array('value' => Translater::getDictionary()->bannermanager_tableActionBanner, 'class' => "thead-actions"),
);
?>
<form id="banner_form" action="<?php echo $this->createUrl("/blockmanager/banner/savechange/") ?>" method="post">
    <?php
    foreach ($tables as $table) {
        if (!empty($table["rows"])) {
            $i = 0;
            foreach ($table["rows"] as $banner) {
                $tablecontent[$banner->banner_id]["index"] = $i + 1;
                $tablecontent[$banner->banner_id]["sort"] = array("sortable" => true);
                $tablecontent[$banner->banner_id]["name"] = "<a href=" . $this->createUrl("/blockmanager/banner/update", array("id" => $banner->banner_id)) . ">" . $banner->banner_name . "</a>";
                $tablecontent[$banner->banner_id]["desc"] = $banner->banner_desc;
                $status["pict"] = $banner->banner_status == 1 ? "" : "unpublished";
                $status["title"] = $banner->banner_status == 1 ? Translater::getDictionary()->status_active : Translater::getDictionary()->status_notactive;
                $tablecontent[$banner->banner_id]["status"] = "<a rel='$banner->banner_id'  class='table-item-status " . $status["pict"] . "' title='" . $status["title"] . "'></a></td>";
                $arrayactions = array(
                    array("class" => "table-action-edit",
                        "action" => $this->createUrl("/blockmanager/banner/update/", array("id" => $banner->banner_id)),
                        "title" => Translater::getDictionary()->button_edit,
                        "onclick" => false,
                        "access" => $this->checkAccess("manageBanner")),
                    array("class" => "table-action-delete",
                        "action" => $this->createUrl("/blockmanager/banner/delete/", array("id" => $banner->banner_id)),
                        "title" => Translater::getDictionary()->button_delete,
                        "onclick" => 'return confirmdelete()',
                        "access" => $this->checkAccess("manageBanner"),
                    ),
                );
                $tablecontent[$banner->banner_id]["action"] = $this->renderPartial("//block/table/table_ul_button", array("actions" => $arrayactions), true, false);
                $i++;
            }
            ?>

            <h3><?php echo $table["header"] ?></h3>
            <?php
            $this->renderPartial('//block/table/simple_table', array('header' => $tableheader, 'body' => $tablecontent, 'tclass' => "bannertable", "tid" => $table["key"]));
            $tablecontent = array();
            ?>
            <br/>
        <? }
    } ?>
</form>