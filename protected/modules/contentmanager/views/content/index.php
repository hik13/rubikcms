<?php
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::app()->getTheme()->getBasePath() . '/js/public/jquery-ui-1.8.6.custom.min.js', CClientScript::POS_HEAD));
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('contentmanager.resourse.js') . '/content.js'), CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('contentmanager.resourse.js') . '/content_sort.js'), CClientScript::POS_HEAD);
$blockButton = array(
    array("name" => Translater::getDictionary()->button_add, "class" => "green", "hidden" => false, "action" => $this->createUrl("/contentmanager/content/create/", array("locale_id" => $locale_id)), "access" => $this->checkAccess("manageContent"), "onclick" => false),
    array("name" => Translater::getDictionary()->button_save, "class" => "", "hidden" => true, "action" => false, "access" => $this->checkAccess("manageContent"), "onclick" => "$('#content_form').submit();"),
    array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "hidden" => true, "action" => $this->createUrl("/contentmanager/"), "access" => $this->checkAccess("manageContent"), "onclick" => false)
);

$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));

foreach ($this->punkts as $key => $punkt) {
    if ($punkt["controller"] == $locale_id) {
        $this->punkts[$key]["active_t"] = true;
        break;
    }
}

$tableheader = array(
    array('value' => Translater::getDictionary()->contentmanager_tablestruktur, 'class' => "site-structure-column"),
    array('value' => Translater::getDictionary()->contentmanager_tablelastmodification, 'class' => "thead-date"),
    array('value' => Translater::getDictionary()->contentmanager_tableAutor, 'class' => "thead-author"),
    array('value' => Translater::getDictionary()->contentmanager_tablestatus, 'class' => "table-cell-no-width"),
    array('value' => Translater::getDictionary()->contentmanager_tableaction, 'class' => "thead-actions"),
);

if (Setting::in()->countActiveLocale) {
    $tableheader[] = array('value' => Translater::getDictionary()->contentmanager_tableTranslatedMaterial, 'class' => "thead-author");
}
?>

<form id="content_form" action="<?php echo $this->createUrl("/contentmanager/content/savetreechange/") ?>" method="post">     
    <?php $this->renderPartial('/redefined/content_tree_table', array('header' => $tableheader, 'content' => $content, "userList" => $userList, 'tclass' => "contenttable", "tid" => "no", "locales" => $locales)); ?>

</form>  

<?php
if (count($content) > 0) {
    $this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));
}
?>