<?php

if ($parameter->parameter_work_id == 1) {
    $this->renderPartial("/item/value/tr_value", array("parameter" => $parameter, "item_id" => $item_id));
} else if ($parameter->parameter_work_id == 2) {
    $this->renderPartial("/item/value/tr_group_value", array("parameter" => $parameter, "item_id" => $item_id));
} else if ($parameter->parameter_work_id == 3) {
    $this->renderPartial("/item/value/tr_master_value", array("parameter" => $parameter, "item_id" => $item_id));
}
?>