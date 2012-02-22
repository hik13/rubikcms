<?php if ($get_full) { ?>
    <div id="image_size_values">
            <?php
            if (is_array($value)) {
                foreach ($value as $key=>$val) {
                    $this->renderPartial("/feeds/template/image_galery", array("get_one_value" => true,"value"=>$val,"name" => $name,'i'=>$key));
                }
            }
            ?>
    </div>
    <div id="add_depfile" class="add_image_size_value">
        <span><?php echo Translater::getDictionary()->feedsmanagerAddGalerySizeValue ?></span>
    </div>
    <?php
} else
if ($get_one_value) {
    ?>
    <div class="block_dependies_div image_size_value_div clearfix" rel="<?php echo $i ?>">
        <div class="dependent-file-location">
                <?php
                $inputs = array(array("type" => "x2",
                    "inputs" => array(array("type" => "x2", "inputs" => array(
                                array("type" => "textfield",
                                    "label" => Translater::getDictionary()->feedsmanagerGalerySizeWidth,
                                    "input" => CHtml::textField($name . "[2][field_value][$i][width]", $value["width"], array("class" => "category")),
                                ),
                                array("type" => "textfield",
                                    "label" => Translater::getDictionary()->feedsmanagerGalerySizeHegth,
                                    "input" => CHtml::textField($name . "[2][field_value][$i][heigth]", $value["heigth"], array("class" => "category")),
                                )
                            )
                        ), array("type" => "nothing",
                            "input" => '<div class="deldependies delete_image_size_value">
            <span>' . Translater::getDictionary()->feedsmanagerDelGalerySizeValue . '</span></div>',)
                        )));
               $this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs)); 
                ?>
            </div>
        </div>
<?php } ?>
