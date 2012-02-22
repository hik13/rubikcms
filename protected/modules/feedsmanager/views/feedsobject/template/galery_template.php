<?php if ($get_full) { ?>
        <div class="form-row clearfix">       
        <div id="galery_image_values">
            <?php
            $size = Image::analyzSizesAndReturn(300, $sizes);
            foreach ($values as $key => $val) {
                $this->renderPartial("/feedsobject/template/galery_template", array("get_value" => true, "value" => $val, "name" => $name, 'i' => $key, "size" => $size));
            }
            ?>
        </div>
        <div id="add_depfile" class="add_galery_image" rel="<?php echo $name ?>">
            <span><?php echo Translater::getDictionary()->feedsmanagerAddGaleryImage ?></span>
        </div>
    </div> 
    <?php
} else if ($get_value) { ?>

            <div class="block_dependies_div galery_image_div clearfix" rel="<?php echo $i ?>">
                <div class="dependent-file-location">
        <?php
        $src=$size."_".$value;
        $image = !empty($value) ? CHtml::hiddenField($name."[]", $value)."<img src='/uploaded/image/$src' />" : "";
        $inputs = array(array("type" => "x2",
                "inputs" => array(
                    array("type" => "nothing",
                        "input" => $image),
                    array("type" => "nothing",
                        "input" => '<div class="deldependies delete_galery_image" style="padding-bottom:10px">
                     <span>'.Translater::getDictionary()->button_delete . '</span></div>'))
                ));
        $this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs));
        ?>
                </div>
            </div>
        <?php
    } else if ($get_image_input) { ?>
    <div class="block_dependies_div galery_image_div clearfix" rel="<?php echo $i ?>">
        <div class="dependent-file-location">
            <?php
            $inputs = array(array("type" => "x2",
                    "inputs" => array(
                        array("type" => "file",
                            "label" => "",
                            "input" => CHtml::fileField($name."[]", "", array("class" => "imageToUpload", "id" => "")),
                        ),
                        array("type" => "nothing",
                            "input" => '<div class="deldependies delete_galery_image" style="padding-right:20px">
                     <span>' . Translater::getDictionary()->button_delete . '</span></div>'))
                    ));
            $this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs)); ?>
                </div>
</div>
       <?php  }
        ?>

