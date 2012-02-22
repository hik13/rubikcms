<?php foreach ($inputs as $input) { ?>
    <div class="column-50-percent">
        <div class="padding-right-18px">
            <?php $this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => array($input))); ?>
        </div>
    </div>
<?php } ?>