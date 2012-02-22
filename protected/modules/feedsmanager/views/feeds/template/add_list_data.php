<?php if ($get_full) { ?>
    <div id="list_data_values">
            <?php
            if (is_array($value)) {
                foreach ($value as $val) {
                    $this->renderPartial("/feeds/template/add_list_data", array("get_one_value" => true,"value"=>$val,"name" => $name));
                }
            }
            ?>
    </div>
    <div id="add_depfile" class="add_list_data_value">
        <span><?php echo Translater::getDictionary()->feedsmanagerAddListDataValue ?></span>
    </div>
    <?php
} else
if ($get_one_value) {
    ?>
    <div class="block_dependies_div list_data_value_div clearfix" rel="<?php echo $i ?>">
        <div class="dependent-file-location">
            <div class="input-border ">
                <?php echo CHtml::textField($name."[2][field_value][]", $value, array("class" => "category")); ?>
            </div>
        </div>
        <div class="deldependies delete_list_data_value">
            <span>
                <?php echo Translater::getDictionary()->feedsmanagerDelListDataValue ?>
            </span>
        </div>
    </div>
<?php } ?>