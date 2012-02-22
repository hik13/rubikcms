<?php
if (is_file($labelList)) {
    $label = require($labelList);
}
if (is_file($valueList)) {
    $argument = require($valueList);
}
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'content-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,)
        ));
?>
<?php if (!empty($label)) { ?>
    <div class="dropdown-block clearfix">
        <a href="#" class="dropdown-button clearfix">
            <div class="closed opened">&nbsp;</div>
            <div class="title">system</div>
        </a>
        <div class="dropdown-content clearfix">
            <input type="hidden" name="<?php echo "translate_path[system]" ?>" value="<?php echo $labelList ?>" />			
            <?php foreach ($label as $key => $value) { ?>
                <div class="form-row clearfix">
                    <div class="column-30-percent">
                        <div class="form-row-item" style="text-align:right">	
                            <label><?php echo $value ?></label>
                        </div>
                    </div>
                    <div class="column-70-percent">
                        <div class="form-row-item">		
                            <div class="input-border">				  	
                                <input size="50" type="text" value="<?php echo $argument[$key] ?>" name="<?php echo "system[" . $key . "]" ?>"></input>
                            </div>
                        </div>
                    </div>   
                </div>	
            <?php } ?>


        </div>
    </div>	
    <?php
} else {
    echo "Языковых версий нету";
}
?>

<?php
if (!empty($modules[$id])) {
    foreach ($modules[$id] as $title => $module) {
        $modules[$defaultLanguage][$key]["filePath"];
        if (!empty($modules[$defaultLanguage][$key]["filePath"])) {
            $label = require($modules[$defaultLanguage][$key]["filePath"]);
        } else {
            $label = require($modules["en"][$title]["filePath"]);
        }

        $blockButton = array("buttons" => array(
                array("name" => Translater::getDictionary()->button_add, "action" => $this->createUrl("/translatemanager/translate/create/", array("id" => "$module[name]")), "class" => "green", "access" => true),)
        );
        ?>
        <div class="dropdown-block clearfix">
            <a href="#" class="dropdown-button clearfix">
                <div class="closed opened">&nbsp;</div>
                <div class='title'><?php echo $title ?></div></a>
            <div class="dropdown-content clearfix">

                <input type="hidden" name="<?php echo "translate_path[" . $title . "]" ?>" value="<?php echo $module["filePath"] ?>" />			
        <?php
        $argument = require($module["filePath"]);
        if (!empty($label)) {
            foreach ($label as $key => $value) {
                ?>
                        <div class="form-row clearfix">
                            <div class="column-30-percent">
                                <div class="form-row-item" style="text-align:right">	
                                    <label><?php echo $value ?></label>
                                </div>
                            </div>
                            <div class="column-70-percent">
                                <div class="form-row-item">		
                                    <div class="input-border">

                                        <input size="50" type="text" value="<?php echo $argument[$key] ?>" name="<?php echo $title . "[" . $key . "]" ?>"></input>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    <?php } ?> 
                <?php
                } else {
                    echo "Языковых версий нету";
                }
                ?>

            </div>
        </div>



    <?php
    }
} else {
    echo "Языковых версий для модулей нету";
}
?>



<?php
$countBlock = 0;
if (!empty($modules[$id])) {
    foreach ($modules["en"] as $key => $value) {
        $countBlock++;
        if (array_key_exists($key, $modules[$id])) {
            $countBlock--;
        }
    }
} else {
    $countBlock = 1;
}

if ($countBlock == 0) {
    $blockButton = array(
    array("name" => Translater::getDictionary()->button_save, "class" => "", "hidden" => false, "action" =>false, "access" => $this->checkAccess("manageTranslate"), "onclick" => "$(this).parents('form').submit();"),
    array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "hidden" => false, "action" => $this->createUrl("/translatemanager/"), "access" => $this->checkAccess("manageTranslate"), "onclick" => false)
        );
} else {
    $blockButton = array(
    array("name" => Translater::getDictionary()->button_add, "class"=>"green","hidden" => false,"action"=>$this->createUrl("/translatemanager/translate/add/", array("id" => "$id")), "access"=>$this->checkAccess("manageTranslate"),"onclick" => false),
    array("name" => Translater::getDictionary()->button_save, "class" => "", "hidden" => false, "action" =>false, "access" =>$this->checkAccess("manageTranslate"), "onclick" => "$(this).parents('form').submit();"),
    array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "hidden" => false, "action" => $this->createUrl("/translatemanager/"), "access" => $this->checkAccess("manageTranslate"), "onclick" => false)

);
}
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));

$this->endWidget();
?>