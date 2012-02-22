<?php
$form = $this->beginWidget('CActiveForm', array(
            'id' => 'language-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
            'validateOnSubmit' => true,)
        ));
if(!empty($modules[$id])){ ?>
	<select name="add_language">
    <?php foreach($modules["en"] as $key=>$value){ ?>
		<?php if(!(array_key_exists($key,$modules[$id]))){ ?>
			<option value="<?php echo $key ?>"><?php echo $key ?></option>
     	<?php } ?> 
	<?php } ?>
<?php } else { ?>
	<select name="add_language">
	 <?php foreach($modules["en"] as $key=>$value){ ?>
     	<option value="<?php echo $key ?>"><?php echo $key ?></option>
     <?php } ?>
     </select> 
	<?php } ?>
</select>
<?php  
$blockButton = array(
    array("name" => Translater::getDictionary()->button_save, "class" => "", "hidden" => false, "action" => false, 'access' => $this->checkAccess("manageTranslate"), "onclick" => "$(this).parents('form').submit();"),
    array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "hidden" => false, "action" => $this->createUrl("/translatemanager/translate/update", array("id"=>"$id")), "access" => $this->checkAccess("manageTranslate"), "onclick" => false),
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));

$this->endWidget(); 
?>