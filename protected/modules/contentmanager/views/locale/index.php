<?php
$blockButton = array(
    array("name" => Translater::getDictionary()->button_add, "class" => "green", "hidden" => false, "action" => $this->createUrl("/contentmanager/locale/create/"), "access" => $this->checkAccess("manageLocale"), "onclick" => false),
    array("name" => Translater::getDictionary()->button_save, "class" => "", "hidden" => false, "action" => false, "access" => $this->checkAccess("manageLocale"), "onclick" => "$('#locale_form').submit()"),
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));
$tableheader = array(
    array('value' => "#", 'class' => "table-cell-no-width thead-checkbox", "sort_now" => true),
    array('value' => Translater::getDictionary()->localemanager_tableNameLocale, 'class' => "thead-title",),
    array('value' => Translater::getDictionary()->localemanager_tableStatusLocale, 'class' => "table-cell-no-width",),
    array('value' => Translater::getDictionary()->localemanager_tableDefaultVersion, 'class' => "thead-checkbox"),
    array('value' => Translater::getDictionary()->localemanager_tableAction, 'class' => "thead-actions",),
);

$i = 0;
foreach ($locales as $locale) {
    $tablecontent[$i]["index"] = $i + 1;
    $tablecontent[$i]["name"] = $locale->locale_description;
    $status["pict"] = $locale->locale_status == 1 ? "" : "unpublished";
    $status["title"] = $locale->locale_status == 1 ? Translater::getDictionary()->status_active : Translater::getDictionary()->status_notactive;
    $tablecontent[$i]["status"] = "<a href='/management/contentmanager/locale/setstatus/locale_id/$locale->locale_id'  class='table-item-status " . $status["pict"] . "' title='" . $status["title"] . "'></a></td>";
    $tablecontent[$i]["rbox"] = CHtml::radioButton("default_locale", $locale->locale_default, array('value' => $locale->locale_id));
    $arrayactions = array(
        array("class" => "table-action-edit",
            "action" => $this->createUrl("/contentmanager/locale/update/", array("id" => $locale->locale_id)),
            "title" => Translater::getDictionary()->button_edit,
            "onclick" => false,
            "access" => $this->checkAccess("manageLocale")),
        array("class" => "table-action-delete",
            "action" => $this->createUrl("/contentmanager/locale/delete/", array("id" => $locale->locale_id)),
            "title" => Translater::getDictionary()->button_delete,
            "onclick" => 'return confirmdelete()',
            "access" => $this->checkAccess("manageLocale"),
        ),
    );
    $tablecontent[$i]["action"] = $this->renderPartial("//block/table/table_ul_button", array("actions" => $arrayactions), true, false);
    $i++;
}
?>

<div class="errors">
    <?php echo $errors; ?>   
</div>
<form id="locale_form" action="<?php echo $this->createUrl("/contentmanager/locale/savedefaultlocale") ?>" method="post">
    <?php $this->renderPartial('//block/table/simple_table', array('header' => $tableheader, 'body' => $tablecontent, 'tclass' => "localetable", "tid" => "no")); ?>
</form>
