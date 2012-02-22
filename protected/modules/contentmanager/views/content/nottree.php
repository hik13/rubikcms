<?php
$blockButton = array(
    array("name" => Translater::getDictionary()->contentmanager_nonstrukt_add,
        "class" => "green",
        "hidden" => false,
        "action" => $this->createUrl("/contentmanager/content/create/", array("nontree" => true)),
        "access" => $this->checkAccess("manageContent"),
        "onclick" => false),
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));

foreach ($this->punkts as $key => $punkt) {
    if ($punkt["controller"] == "nottree") {
        $this->punkts[$key]["active_t"] = true;
        break;
    }
}

$tableheader = array(
    array('value' => "<input type='checkbox' id='checkall' onclick='checkitAll(this,\"table\")'>", 'class' => "table-cell-no-width", "sortable" => false, "sort_now" => false),
    array('value' => Translater::getDictionary()->contentmanager_tableNameContent, 'class' => "", "sortable" => true, "sort_now" => false),
    array('value' => Translater::getDictionary()->contentmanager_tableLink, 'class' => "", "sortable" => true, "sort_now" => false),
    array('value' => Translater::getDictionary()->contentmanager_tableaction, 'class' => "", "sortable" => false, "sort_now" => false),
);
if (Setting::in()->countActiveLocale) {
    $tableheader[] = array('value' => Translater::getDictionary()->contentmanager_tableLocaleVersion, 'class' => "thead-author");
    $tableheader[] = array('value' => Translater::getDictionary()->contentmanager_tableTranslatedMaterial, 'class' => "thead-author");
}

$i = 0;
$tablecontent = array();

foreach ($content as $item) {
    $tablecontent[$i]["cbox"] = CHtml::CheckBox("content_id[" . $i . "]", false, array('value' => $item["parent"]["content_id"]));
    $tablecontent[$i]["name"] = $item["parent"]["name"];
    $tablecontent[$i]["link"] = $_SERVER[HTTP_HOST] . "/" . $item["parent"]["textlink"] . "/";
    $arrayactions = array(
        array("class" => "table-action-edit",
            "action" => $this->createUrl("/contentmanager/content/update/", array("id" => $item["parent"]["content_id"])),
            "title" => Translater::getDictionary()->button_edit,
            "onclick" => false,
            "access" => $this->checkAccess("manageContent")
        ),
        array("class" => "table-action-delete",
            "action" => $this->createUrl("/contentmanager/content/delete/", array("id" => $item["parent"]["content_id"])),
            "title" => Translater::getDictionary()->button_delete,
            "onclick" => 'return confirmdelete()',
            "access" => $this->checkAccess("manageContent")
        ),
    );
    $tablecontent[$i]["action"] = $this->renderPartial("//block/table/table_ul_button", array("actions" => $arrayactions), true, false);
    if (Setting::in()->countActiveLocale) {
    $tablecontent[$i]["lversion"]= $locales[$item["parent"]["locale_id"]];
    $string="";
    foreach ($locales as $key => $locale) {
            if ($key != $item["parent"]["locale_id"]) {
                if (is_array($item["relate"])) {
                    if ($key_id = array_search($key, $item["relate"])) {
                       $string.='<a title="'.Translater::getDictionary()->button_edit.'" style="color:blue" href="'.$this->createUrl("/contentmanager/content/update/", array("id" => $key_id)).'">'.$locale.'</a>&nbsp;';   
                      } else { 
                       $string.='<a title="'.Translater::getDictionary()->button_add.'"  href="'.$this->createUrl("/contentmanager/content/create/", array("locale_id" => $key, "related_content" => $item["parent"]["content_id"])).'">'.$locale.'</a>&nbsp;';                                                         
                      }
                } else { 
                    $string.='<a title="'.Translater::getDictionary()->button_add.'"  href="'.$this->createUrl("/contentmanager/content/create/", array("locale_id" => $key)).'">'.$locale.'</a>&nbsp;';                             
                }
            }
    }
    $tablecontent[$i]["trversion"]= $string;
}
    $i++;
}
?>

<form id="content_form" action="<?php echo $this->createUrl("/contentmanager/content/savetreechange/") ?>" method="post">
    <?php $this->renderPartial('//block/table/simple_table', array('header' => $tableheader, 'body' => $tablecontent, 'tclass' => "nottreecontenttable", "tid" => "no")); ?>
</form>

<?php
if (count($tablecontent) > 0) {
    $this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));
}
?>