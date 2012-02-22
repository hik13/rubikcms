<tr class="subsection-title" >
    <td colspan="2">
        <?php echo $parameter->parameter_name ?>
    </td>
</tr>  
<?php
if (!empty($parameter->group)) {
    foreach ($parameter->group as $group_p) {
        $this->renderPartial("/item/value/tr_value", array("parameter" => $group_p,"item_id"=>$item_id));
    }
}
