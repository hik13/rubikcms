<div class="unit-value-block">	
    <ul class="unit-value">
        <?php foreach ($dimensions as $model) { ?>
            <li class="dimension_value" rel="<?php echo $model->dimension_id ?>">
                <?php echo $model->dimension_name ?>
                <div class="modal-actions">
                    <a  class="dimension-unit-edit unit-edit"></a> 
                    <a  class="dimension-unit-delete unit-delete"></a>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>
