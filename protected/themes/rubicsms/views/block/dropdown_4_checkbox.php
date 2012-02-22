<div class="dropdown-block clearfix">
    <div class="dropdown-header clearfix">
        <?php if ($if_delete) { ?>
            <a class="dropdown-delete" onclick="<?php echo $on_delete; ?>" >
                <?php echo Translater::getDictionary()->button_delete; ?>
            </a>
        <?php } ?>
        <a class="dropdown-button opened"></a>
        <div class="dropdown-title">
            <?php echo $dropdown_header_value; ?>
        </div>
    </div>
    <div class="dropdown-content clearfix">
        <?php
        $counter = 0;
        $in_column = floor(count($array_chekbox) / 4);
        $i=0;
        foreach ($array_chekbox as $chekbox) {
            if (($counter == 0)) {
                ?>
                <div class="column-25-percent">		
                    <div class="padding-right-18px"> 
                        <?php } ?>
                    <div class="form-row clearfix checkbox"> 
                        <?php echo $chekbox["chekbox"]; ?>
                    <?php echo $chekbox["label"]; ?>
                    </div> 
                    <?php
                    $counter++;
                    if (!($counter < $in_column)) {
                        $counter = 0;
                    }
                    if (($counter == 0) or ((count($array_chekbox) - 1) == $i)) {
                        ?>
                    </div>
                </div> 
                <?php
            }
            $i++;
        }
        ?>    
    </div>
</div>