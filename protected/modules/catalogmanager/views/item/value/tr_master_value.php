<tr>
    <td class="label-td">
        <?php echo $parameter->parameter_name ?>
    </td>
    <td>
        <?php echo $parameter->returnInputByWorkId($item_id); ?>
    </td>
</tr>  
<tr>
    <td colspan="2">
        <table id="slave_parameter">
            <?php
            if ($parameter->issetValue()) {
                $slaves=Parameter::model()
                        ->with(array("multiple_value"=>array("condition"=>"master_value_id=:master_value_id","params"=>array(":master_value_id"=>$parameter->value->value))))
                        ->findAll(array("condition"=>"parameter_slave_id=:parameter_slave_id","params"=>array(":parameter_slave_id"=>$parameter->parameter_id)));
                 foreach ($slaves as $slave) {
                       $this->renderPartial("/item/value/parameter_value", array("parameter" => $slave, "item_id" => $item_id));
                 }
            }
            ?>
        </table>
    </td>
</tr>  