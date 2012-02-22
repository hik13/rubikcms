<?php
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('catalogmanager.resourse.js').'/manufactered.js') ,CClientScript::POS_HEAD);

 $blockButton = array(
    array("name" => Translater::getDictionary()->catalogmanager_buttonAddManufacturer, "class"=>"green","hidden" => false,"action"=>$this->createUrl("/catalogmanager/manufacturer/create/"), "access"=>$this->checkAccess("manageManufacturer"),"onclick" => false),
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));

$arrayEng= array ("0-9"=>"digit","A"=>"a","B"=>"b","C"=>"c","D"=>"d","E"=>"e","F"=>"f","G"=>"g","H"=>"h","I"=>"i",
        "J"=>"j","K"=>"k","L"=>"l","M"=>"m","N"=>"n","O"=>"o","P"=>"p","Q"=>"q","R"=>"r",
        "S"=>"s","T"=>"t","U"=>"u","V"=>"v","W"=>"w","X"=>"x","Y"=>"y","Z"=>"z");
$arrayRus= array ("А"=>"а","Б"=>"б","В"=>"в","Г"=>"г","Д"=>"д","Е"=>"е","Ж"=>"ж","З"=>"з","И"=>"и",
        "К"=>"к","Л"=>"л","М"=>"м","Н"=>"н","О"=>"о","П"=>"п","Р"=>"р","С"=>"с","Т"=>"т",
        "У"=>"у","Ф"=>"ф","Х"=>"х","Ц"=>"ц","Ч"=>"ч","Ш"=>"ш","Щ"=>"щ","Э"=>"э","Ю"=>"ю","Я"=>"я");
?>

<h1> <?php  echo Translater::getDictionary()->catalogmanager_ManufacturerName?></h1>
<input type="hidden" id="activeLetter" value="<?php echo $letter ?>" />
<div align="center" class="abc">
    <?php foreach ($arrayEng as $key=>$eng) { ?>
    <a href="<?php echo $this->createUrl("/catalogmanager/manufacturer/index/",array("letter"=>$eng)) ?>" rel="<?php echo $eng ?>"><?php echo $key ?></a>
        <?php } ?>
    <br/><br/>
    <?php foreach ($arrayRus as $key=>$rus) { ?>
    <a href="<?php echo $this->createUrl("/catalogmanager/manufacturer/index/",array("letter"=>$rus)) ?>" rel="<?php echo $rus ?>"><?php echo $key ?></a>
        <?php } ?>
</div>
<div id="letter">
    <?php echo $letter; ?>
</div>
<div id="manufacturer_div">
    <?php
    if (!empty($array)) {
        foreach ($array as $ar) {
            if ($this->checkAccess("manageManufacturer")) { ?>
    <a href="<?php echo $this->createUrl("/catalogmanager/manufacturer/update/",array("id"=>$ar["id"])) ?>"><?php echo $ar["name"] ?></a><br/>
                <?php } else {
                echo $ar["name"] ?><br/>
                <?php  }
        }
    }
    ?>
</div>