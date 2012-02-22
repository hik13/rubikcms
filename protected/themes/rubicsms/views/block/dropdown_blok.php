<div class="dropdown-block clearfix">
    <div class="dropdown-header clearfix">
        <?php if ($if_delete) { ?>
            <a  class="dropdown-delete">
                <?php echo Translater::getDictionary()->button_delete; ?>
            </a>
        <?php } ?>
        <a class="dropdown-button opened"></a>
        <div class="dropdown-title">
            <?php echo $dropdown_header_value; ?>   
        </div>
    </div>
        <div class="dropdown-content clearfix">     
            <?php $this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs)); ?>
        </div>
</div>
