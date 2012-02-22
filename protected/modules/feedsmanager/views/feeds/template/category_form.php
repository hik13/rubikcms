<div class="block_dependies_div category_div clearfix" rel="<?php echo $i ?>">
    <div class="dependent-file-location">
        <div class="input-border ">
        <?php echo CHtml::textField("Feeds[category][$i]", $value, array("class" => "category")); ?>
        </div>
    </div>
    <div class="deldependies delete_category">
        <span>
            <?php echo Translater::getDictionary()->feedsmanagerDelCategory ?>
        </span>
    </div>
</div>

