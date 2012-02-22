<h1><?php echo Translater::getDictionary()->translatemanagerLocaleList ?></h1>
<?php
$blockButton = array(
    array("name" => Translater::getDictionary()->button_add, "class"=>"green","hidden" => false,"action"=>$this->createUrl("/translatemanager/translate/create/"), "access"=>$this->checkAccess("manageTranslate"),"onclick" => false),
   

);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));


$tableheader = array(
    array('value' => "#", 'class' => "table-cell-no-width", "sort_now" => true),
    array('value' => Translater::getDictionary()->translatemanagerLocaleName, 'class' => ""),
    array('value' => Translater::getDictionary()->translatemanageractions, 'class' => "",),
);


if (!empty($list)) {
    $counter = 1;
    foreach ($list as $lang) {
        $tablecontent[$counter]["index"] = $counter;
        $tablecontent[$counter]["name"] = $lang["name"];
        $arrayactions = array(
            array("class" => "table-action-edit",
                "action" => $this->createUrl("/translatemanager/translate/update/", array("id" => "$lang[name]")),
                "title" => Translater::getDictionary()->button_edit,
                "access" => $this->checkAccess("manageTranslate")),
            array("class" => "table-action-delete",
                "action" => $this->createUrl("/translatemanager/translate/delete/", array("id" => "$lang[name]")),
                "title" => Translater::getDictionary()->button_delete,
                "access" => $this->checkAccess("manageTranslate")),
        );
        $tablecontent[$counter]["action"] = $this->renderPartial("//block/table/table_ul_button", array("actions" => $arrayactions), true, false);
        ?>
        <?php $counter++; ?> 
    <?php } ?>
    <?php
} else {
    echo "Языковых версий нету";
}
?>		
<?php
    $this->renderPartial('//block/table/simple_table', array('header' => $tableheader,'body' => $tablecontent, 'tclass' => "translatestable", "tid" =>"no"));
?>