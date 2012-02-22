<?php
$class=$parameter->parameter_work_id?"master_select":"";

if ($parameter->parameter_type_id == 2) {
    $dimens=$parameter->dimension->dimension_cut;
    $value->value=$value->value*1;
    array_walk($data,create_function('&$v,$k', 'if (is_numeric($v)) $v = $v *1 ;'));
}

echo CHtml::hiddenField("Item[ValueSelectable][" . $i . "][id]", $value->id, array("class"=>"count_value"));
echo CHtml::hiddenField("Item[ValueSelectable][" . $i . "][parameter_id]", $parameter->parameter_id, array("class"=>"parameter_id"));
echo CHtml::hiddenField("Item[ValueSelectable][" . $i . "][parameter_work_id]", $parameter->parameter_work_id, array());
echo CHtml::hiddenField("Item[ValueSelectable][" . $i . "][parameter_type_id]", $parameter->parameter_type_id, array());
echo CHtml::hiddenField("Item[ValueSelectable][" . $i . "][parameter_number_id]", $parameter->parameter_number_id, array());
echo CHtml::dropDownList("Item[ValueSelectable][" . $i . "][value]", $value->value, $data, array("class"=>$class));
echo $dimens;

?> 
