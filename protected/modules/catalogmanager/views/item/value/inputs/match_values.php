<?php

echo CHtml::hiddenField("Item[ValueSelectable][" . $i . "][parameter_id]", $parameter->parameter_id, array("class" => "count_value"));
echo CHtml::hiddenField("Item[ValueSelectable][" . $i . "][parameter_work_id]", $parameter->parameter_work_id, array());
echo CHtml::hiddenField("Item[ValueSelectable][" . $i . "][parameter_work_id]", $parameter->parameter_work_id, array());
echo CHtml::hiddenField("Item[ValueSelectable][" . $i . "][parameter_type_id]", $parameter->parameter_type_id, array());
echo CHtml::hiddenField("Item[ValueSelectable][" . $i . "][parameter_number_id]", $parameter->parameter_number_id, array());
$j = 0;

if ($parameter->parameter_type_id == 2) {
    $dimens = $parameter->dimension->dimension_cut;
    if (is_array($value)) {
        array_walk($value, create_function('&$v,$k', 'if (is_numeric($v)) $v = $v *1 ;'));
    }
    array_walk($data, create_function('&$v,$k', 'if (is_numeric($v)) $v = $v *1 ;'));
}

foreach ($data as $key => $dat) {
    $cheked = false;
    if (is_array($value)) {
        if ($id = array_search($key, $value)) {
            $cheked = true;
            ;
        }
    }
    echo CHtml::label($dat, "input");
    echo CHtml::hiddenField("Item[ValueSelectable][" . $i . "][value][$j][id]", $id, array());
    echo CHtml::checkBox("Item[ValueSelectable][" . $i . "][value][$j][value]", $cheked, array("value" => $key));
    echo $dimens;
    $j++;
}
