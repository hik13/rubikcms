<?php
$form = $this->beginWidget('CActiveForm', array(
            'id' => 'language-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
            'validateOnSubmit' => true,)
        ));
?>
<table>
	<tr>
		<td>
			<label>Введите префикс языка</label>
        </td>
        <td>
    		<div class="form-row clearfix">
        	<div class="input-border"><input type="text" name="LanguageName" value="ru" /></div>
            </div>
        </td>
    </tr>
</table>
<?php 

$blockButton = array(
    array("name" => Translater::getDictionary()->button_save, "class" => "", "hidden" => false, "action" => false, 'access' => $this->checkAccess("manageTranslate"), "onclick" => "$(this).parents('form').submit();"),
    array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "hidden" => false, "action" => $this->createUrl("/translatemanager/"), "access" => $this->checkAccess("manageTranslate"), "onclick" => false),
);
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));

$this->endWidget(); 
?>