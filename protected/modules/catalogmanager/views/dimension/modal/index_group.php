<li rel="<?php echo $model->dimension_group_id; ?>" class="<?php echo $class; ?>" >
    <div class="unit-item">
        <div class="dimension-group-unit-title unit-title"> <?php echo $model->dimension_group_name ?></div>
        <div class="modal-actions">
            <a  class="dimension-group-unit-add unit-add"></a>
            <a  class="dimension-group-unit-edit unit-edit"></a>
            <a  class="dimension-group-unit-delete unit-delete"></a>
        </div>
    </div>

    <div class="unit-edit-block">
        <div class="unit-edit-input">
            <div class="input-border">
                <?php  echo CHtml::hiddenField("DimensionGroup[dimension_group_id]",$model->dimension_group_id,array("id"=>"dimension_group_id_input"))?>
                <?php  echo CHtml::textField("DimensionGroup[dimension_group_name]",$model->dimension_group_name,array("id"=>"dimension_group_name_input"))?>
            </div>
        </div>
        <div class="modal-actions">
            <a  class="dimension-group-unit-update unit-ok"></a>
            <a  class="dimension-group-unit-update-cansel unit-cancel"></a>
        </div>		
    </div>
</li>