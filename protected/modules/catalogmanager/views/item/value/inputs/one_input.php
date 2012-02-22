<?php
echo CHtml::hiddenField("Item[ValueSelectable][" . $i . "][id]", $value->id, array("class"=>"count_value"));
echo CHtml::hiddenField("Item[ValueSelectable][" . $i . "][parameter_id]", $parameter->parameter_id, array());
echo CHtml::hiddenField("Item[ValueSelectable][" . $i . "][parameter_work_id]", $parameter->parameter_work_id, array());
echo CHtml::hiddenField("Item[ValueSelectable][" . $i . "][parameter_type_id]", $parameter->parameter_type_id, array());
echo CHtml::hiddenField("Item[ValueSelectable][" . $i . "][parameter_number_id]", $parameter->parameter_number_id, array());

if ($parameter->parameter_type_id == 2) {
    $dimens=$parameter->dimension->dimension_cut;
    $value->value=$value->value*1;
}

?>
<div class="input-border"> 
    <?php echo CHtml::textField("Item[ValueSelectable][" . $i . "][value]", $value->value, array()); ?>
</div>   
<?php
echo $dimens;
?>
