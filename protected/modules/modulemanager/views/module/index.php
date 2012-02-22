<?php
JsRegistry::getInstance()->sortTable("moduletable", "module_order", "module_order", "simple-button");

$blockButton = array(
    array("name" => Translater::getDictionary()->button_confirmChanges, "class" => "", "hidden" => false, "action" => false, 'access' => $this->checkAccess("manageModule"), "onclick" => "$('#modul_form').submit()"),
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));



foreach ($installed as $modul) {
    Translater::setDictionary(Yii::app()->basePath . "/modules" . $modul["defaultCntrl"] . "messages", $modul["class"]);
}
foreach ($notinstalled as $modul) {
    Translater::setDictionary(Yii::app()->basePath . "/modules" . $modul["defaultCntrl"] . "messages", $modul["class"]);
}


$tableheader = array(array('value' => "", 'class' => "table-cell-no-width thead-checkbox"),
    array('value' => "#", 'class' => "table-cell-no-width thead-number"),
    array('value' => "", 'class' => "table-cell-no-width empty-cell"),
    array('value' => Translater::getDictionary()->modulemanager_tableNameModule, 'class' => "thead-title"),
    array('value' => Translater::getDictionary()->modulemanager_tableDeskModule, 'class' => "thead-description")
);
$i = 0;
$j=0;
foreach ($installed as $modul) {
    $tablecontent["instaled"][$modul["module_id"]]["cbox"] = CHtml::CheckBox("module_id[" . $i . "]", true, array('value' => $modul["module_id"], 'disabled' => $modul["required"]));
    $tablecontent["instaled"][$modul["module_id"]]["index"] = ($i + 1);
    $tablecontent["instaled"][$modul["module_id"]]["sort"] = array("sortable" => true);
    $tablecontent["instaled"][$modul["module_id"]]["name"] = "<a href=" . $this->createUrl($modul["defaultCntrl"]) . ">" . Translater::getDictionary()->$modul["module_name"] . "</a>";
    $tablecontent["instaled"][$modul["module_id"]]["desc"] = Translater::getDictionary()->$modul["modulDescription"];
    $i++;
}
foreach ($notinstalled as $modul) {
    $tablecontent["notinstaled"][$modul["module_id"]]["cbox"] = CHtml::CheckBox("module_id[" . ($j + $i) . "]", false, array('value' => $modul["module_id"], 'disabled' => $modul["required"]));
    $tablecontent["notinstaled"][$modul["module_id"]]["index"] = ($j + 1);
    $tablecontent["notinstaled"][$modul["module_id"]]["sort"] = "";
    $tablecontent["notinstaled"][$modul["module_id"]]["name"] = Translater::getDictionary()->$modul["module_name"];
    $tablecontent["notinstaled"][$modul["module_id"]]["desc"] = Translater::getDictionary()->$modul["modulDescription"];
    $j++;
}
?>
<form id="modul_form" action="<?php echo $this->createUrl("/modulemanager/module/savelistmodule/") ?>" method="post">
    <?php $this->renderPartial('//block/table/simple_table', array('header' => $tableheader, 'body' => $tablecontent["instaled"], 'tclass' => "moduletable", "tid" => "no")); ?>
    <br/>
    <?php 
    if (count($tablecontent["notinstaled"])>0){
    $this->renderPartial('//block/table/simple_table', array('header' => $tableheader, 'body' => $tablecontent["notinstaled"], 'tclass' => "moduletable_ni", "tid" => "no"));
    }
    ?>
</form>