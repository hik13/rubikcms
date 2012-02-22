<div class="modal-overlay">
    <div class="modal-window rounded-corners-10px box-shadow-10px clearfix">
        <div class="sub-section clearfix">
            <div id="modal-dimension-window">  
                <h1><?php echo Translater::getDictionary()->catalogmanager_catalogDimensionModalWindowTitle ?></h1>

                <a id="modal-window-close" class="extended-main-menu-close"></a>
                <div id="group_column" class="column-50-percent">
                    <div class="padding-right-18px">
                        <div id="first-column-modal">
                            <div class="add-new-unit-group">
                                <label><?php echo Translater::getDictionary()->catalogmanager_catalogDimensionModalWindowAddGroupTitle ?></label>
                                <div class="form-row clearfix">			
                                    <div class="input-border">
                                        <input id="dimension_group_name_input" name="DimensionGroup[dimension_group_name]" type="text" value="" />
                                    </div>
                                </div>
                                <a id="add-dimension-group" class="add-group-parametr"><?php echo Translater::getDictionary()->button_add ?></a>
                            </div>
                            <ul class="unit">
                                <?php
                                foreach ($models as $key => $model) {
                                    $class = $key == 0 ? "active-unit" : "";
                                    ?>
                                    <?php $this->renderPartial('modal/index_group', array('model' => $model, "class" => $class)); ?>
<?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="column-50-percent">
                    <div class="padding-left-18px">	
                        
                       
                        <div id="second-column-modal">
                         <?php $this->renderPartial('modal/index_dimension', array('dimensions' => $models[0]->units)); ?>
                        </div>
                       
                    </div>
                </div>
                 <?php
                        echo CHtml::hiddenField("link_selectable_input_name", $_GET["selectable_input_name"], array("class" => "link_selectable_input_name"));
                        ?>
                       <?php $blockButton = array(array("name" => Translater::getDictionary()->button_save,
                                "class" => " insert_button",
                                "hidden" => true,
                                "action" => false,
                                'access' => $this->checkAccess("manageDimension"),
                                "onclick" => false));
                        $this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => "right-position"));
                        ?>
            </div>

        </div>


    </div>
</div>
