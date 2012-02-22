<?php

$array["checkbox_field"] = array("checkbox");
$array["select_field"] = array("select", "file","radiobutton");
$array["text_field"] = array("textfield", "textarea");
$array["not_render"] = array("hidden", "nothing");
$array["multiple"] = array("x2");
$array["array"] = array("array");

foreach ($inputs as $input) {
    switch ($input["type"]) {
        case in_array($input["type"], $array["text_field"]) : {
                $this->renderPartial("//block/inputs/text_field", array(
                    "additional_class" => $input["additional_class"],
                    "label" => $input["label"],
                    "input" => $input["input"],
                    "error" => $input["error"],
                ));
                break;
            }
        case in_array($input["type"], $array["select_field"]) : {
                $this->renderPartial("//block/inputs/select_field", array(
                    "additional_class" => $input["additional_class"],
                    "label" => $input["label"],
                    "input" => $input["input"],
                ));
                break;
            }
        case in_array($input["type"], $array["checkbox_field"]) : {
                $this->renderPartial("//block/inputs/checkbox_field", array(
                    "additional_class" => $input["additional_class"],
                    "label" => $input["label"],
                    "input" => $input["input"],
                ));
                break;
            }
        case in_array($input["type"], $array["not_render"]) : {
                echo $input["input"];
                break;
            }
        case in_array($input["type"], $array["multiple"]) : {
                $this->renderPartial("//block/inputs/inputs-" . $input["type"], array(
                    "inputs" => $input["inputs"],
                ));
                break;
            }
        case in_array($input["type"], $array["array"]) : {
                $this->renderPartial("//block/inputs/rendertypedInputs", array(
                    "inputs" => $input["inputs"],
                ));
                break;
            }
    }
}
?>
