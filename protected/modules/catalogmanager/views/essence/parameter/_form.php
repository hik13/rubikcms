<?php
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::app()->getTheme()->getBasePath() . '/js/public/jquery-ui-1.8.6.custom.min.js', CClientScript::POS_HEAD));
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('catalogmanager.resourse.js') . '/sort.js'), CClientScript::POS_HEAD);
$j = $model->getParameterId();
$inputs = array(
    array("type" => "hidden",
        "input" => CHtml::hiddenField("Parameter[$j][helpname]", "Parameter[$j]", array("class" => "parameter_help_name")),
    ),
    array("type" => "hidden",
        "input" => CHtml::hiddenField("Parameter[$j][parameter_id]", $model->parameter_id, array("class" => "parameter")),
    ),
    array("type" => "hidden",
        "input" => CHtml::hiddenField("Parameter[$j][temp_parameter_id]", $model->getParameterId(), array("class" => "parameter_id")),
    ),
    array("type" => "hidden",
        "input" => CHtml::hiddenField("Parameter[$j][parameter_group_id]", $model->parameter_group_id, array("class" => "group_parameter_id")),
    ),
    array("type" => "hidden",
        "input" => CHtml::hiddenField("Parameter[$j][parameter_slave_id]", $model->parameter_slave_id, array("class" => "slave_parameter_id")),
    ),
    array("type" => "hidden",
        "input" => CHtml::hiddenField("Parameter[$j][parameter_joint_id]", $model->parameter_joint_id, array("class" => "joint_parameter_id")),
    ),
    array("type" => "textfield",
        "label" => CHtml::activelabel($model, "parameter_name"),
        "input" => CHtml::textField("Parameter[$j][parameter_name]", $model->parameter_name, array('class' => "parameterName", 'size' => 60, 'maxlength' => 300)),
        "error" => CHtml::error($model, 'parameter_name'),
    ),
    array("type" => "textfield",
        "label" => CHtml::activelabel($model, "parameter_short_name"),
        "input" => CHtml::textField("Parameter[$j][parameter_short_name]", $model->parameter_short_name, array('size' => 60, 'maxlength' => 100)),
        "error" => CHtml::error($model, 'parameter_short_name'),
    ),
    array("type" => "textfield",
        "label" => CHtml::activelabel($model, 'parameter_description'),
        "input" => CHtml::textArea("Parameter[$j][parameter_description]", $model->parameter_description, array('rows' => 4)),
        "error" => CHtml::error($model, 'parameter_description'),
    ),
    array("type" => "select",
        "label" => CHtml::activelabel($model, "parameter_key_sort"),
        "input" => CHtml::dropDownList("Parameter[$j][parameter_key_sort]", $model->parameter_key_sort, $model->boolean, array("class" => "input_key_sort")),
        "error" => CHtml::error($model, 'parameter_key_sort', array("class" => "error-form-message")),
    ),
    array("type" => "select",
        "label" => CHtml::activelabel($model, "parameter_primary_sort"),
        "input" => CHtml::dropDownList("Parameter[$j][parameter_primary_sort]", $model->parameter_primary_sort, $model->boolean, array("class" => "input_primary_sort")),
        "error" => CHtml::error($model, 'parameter_primary_sort', array("class" => "error-form-message")),
    ),
);

if ($model->parameter_slave_id) {
    ?>
    <script type="text/javascript">
        $(function(){
            loadSelect($("li[rel='<?php echo $j; ?>']"));
        })
    </script> 
<?php } ?>

    


<li id="<?php echo $j; ?>" class="parameter" rel="<?php echo $j; ?>">   
    <div class="menu-item active-item clearfix">        
        <div class="section-parameter-title" 
        <?php if ($model->isNewRecord) { ?>
                 style="display:none"
             <?php } ?>
             >	
            <div class="inner-border clearfix">	
                <ul class="table-action-buttons clearfix">
                    <?php if (in_array($model->parameter_work_id, array(2, 3))) { ?>
                        <li class="table-action-add">
                            <a title="<?php echo Translater::getDictionary()->button_add ?>" onclick="addTypedParameter(<?php echo $model->parameter_work_id ?>, this)"></a>
                        </li>
                    <?php } ?>

                    <li class="table-action-delete">
                        <a title="<?php echo Translater::getDictionary()->button_delete ?>" onclick="deleteEssenseObject($(this).parents('li.parameter:first'),<?php echo $model->isNewRecord ? "true" : "false" ?>,'Parameter',<?php echo $model->isNewRecord ? "0" : $model->parameter_id ?>)"></a>
                    </li>
                </ul>
                <a class="form-button" onclick="showParamForm(this)"><?php echo $model->parameter_name ?></a>

                <div class="catalog-main-parametr" title="<?php echo Translater::getDictionary()->catalogmanager_keyParameterTitle ?>"
                <?php if ($model->parameter_key_sort == 0) { ?>
                         style="display:none"
                     <? } ?>
                     ></div>
                <div class="catalog-filtr-parametr" title="<?php echo Translater::getDictionary()->catalogmanager_primarySortParameterTitle ?>"
                <?php if ($model->parameter_primary_sort == 0) { ?>
                         style="display:none"
                     <? } ?>
                     ></div>
            </div>
        </div>
        <div class="catalog-edit-form"  
        <?php if (!$model->isNewRecord) { ?>
                 style="display:none"
             <?php } ?>>
            <div class="catalog-edit-pointer">
            </div>  
            <?php
            $this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs));


            if ($model->parameter_slave_id) {
                ?>
                <div id="slave_select">
                    <div class="form-row clearfix">
                        <?php echo CHtml::label(Translater::getDictionary()->catalogmanager_parameterMasterValue, "select_area"); ?>
                        <?php
                        foreach ($model->multiple_value as $mv) {
                            $str.=$mv->master_value_id . ",";
                        }
                        $str = substr($str, 0, -1);
                        echo CHtml::hiddenField("master_value", $str, array("class" => "master_value"));
                        ?>
                                
                                
                        <div id="select_area">
                        </div>  
                    </div>  
                </div>     
            <?php } ?>
                
                
                
            <div id="work">
                <div class="form-row clearfix">
                    <?php echo CHtml::activelabel($model, "parameter_work_id"); ?>
                    <?php echo CHtml::dropDownList("Parameter[$j][parameter_work_id]", $model->parameter_work_id, $model->work_type, array("class" => "work_type")); ?>
                    <?php echo CHtml::error($model, 'parameter_work_id', array("class" => "error-form-message")); ?>
                </div>  
                <div id="group_parameter_area"
                <?php if (!($model->parameter_work_id == 2)) { ?>
                         style="display:none"
                     <?php } ?>
                     class="form-row clearfix appendforwork">       
                         <?php echo CHtml::activelabel($model, "parameter_separator"); ?>
                    <div class="input-border">
                        <?php echo CHtml::textField("Parameter[$j][parameter_separator]", $model->parameter_separator, array("class" => "parameter_separator")); ?>  
                    </div>
                    <?php echo CHtml::error($model, 'parameter_separator', array("class" => "error-form-message")); ?>
                </div>
            </div>     

            <?php if ($model->isNewRecord) { ?>
                <div id="type">
                    <div   class="form-row clearfix">
                        <?php echo CHtml::activelabel($model, "parameter_type_id"); ?>
                        <?php echo CHtml::dropDownList("Parameter[$j][parameter_type_id]", $model->parameter_type_id, $model->data_type, array("class" => "type_type")); ?>
                        <?php echo CHtml::error($model, 'parameter_type_id', array("class" => "error-form-message")); ?>
                    </div>
                    <div id="parameter_dimension_area" style="display:none" class="form-row clearfix appendforwork">
                        <?php echo CHtml::activelabel($model, "parameter_dimension_id"); ?>
                        <div class="dimension_text_value"></div>
                        <img src="/protected/themes/rubicsms/theme-images/modal-window/show_button.png"  class="show-modal"/>
                        <?php echo CHtml::hiddenField("Parameter[$j][parameter_dimension_id]", $model->parameter_dimension_id, array("class" => "parameter_dimension_id")); ?>  
                                
                        <?php echo CHtml::error($model, 'parameter_dimension_id', array("class" => "error-form-message")); ?>
                    </div>
                </div>   
                <div id="number">
                    <div   class="form-row clearfix">
                        <?php echo CHtml::activelabel($model, "parameter_number_id"); ?>
                        <?php echo CHtml::hiddenField("Parameter[$j][parameter_number_id]", 2, array("class" => "number_type")); ?>
                        <?php echo CHtml::dropDownList("Parameter[$j][parameter_number_id]", $model->parameter_number_id, $model->number_type, array("id" => "active", "class" => "number_type")); ?>
                        <?php echo CHtml::error($model, 'parameter_number_id', array("class" => "error-form-message")); ?>
                    </div>
                    <div class="selectable_values" style="display:none">
                        <div class="master-group-parametrs">
                            <label><?php echo Translater::getDictionary()->catalogmanager_selectableValueTitle ?></label>
                                    
                        </div>   
                        <div class="master-group-parametr-add" >
                            <div class="form-row clearfix">
                                <div class="input-border">
                                    <input id="add_selectable_value_input" type="text" value=" " />
                                </div>
                                <a class="add_selectable_value_input_button add-group-parametr"><?php echo Translater::getDictionary()->button_add ?></a>
                            </div>				
                        </div> 
                    </div>
                </div>  
                        
            <?php } else {

                if (!($model->parameter_work_id == 2)) { ?>
                    <div class="form-row clearfix">
                        <?php echo CHtml::activelabel($model, "parameter_type_id"); ?>
                        <?php echo CHtml::hiddenField("Parameter[$j][parameter_type_id]", $model->parameter_type_id, array("class" => "type_type")); ?>
                        <?php echo $model->data_type[$model->parameter_type_id] ?>
                    </div>  
                    <?php if ($model->parameter_type_id == 2) { ?>
                        <div class="form-row clearfix">
                            <?php echo CHtml::activelabel($model, "parameter_dimension_id"); ?>
                            <div class="dimension_text_value"><?php echo $model->dimension->dimension_name ?></div> 
                            <img src="/protected/themes/rubicsms/theme-images/modal-window/show_button.png"  class="show-modal"/>
                            <?php echo CHtml::hiddenField("Parameter[$j][parameter_dimension_id]", $model->parameter_dimension_id, array("class" => "parameter_dimension_id")); ?>  
                        </div>  
                    <?php } ?>
                    <div class="form-row clearfix">
                        <?php echo CHtml::activelabel($model, "parameter_number_id"); ?>
                        <?php echo CHtml::hiddenField("Parameter[$j][parameter_number_id]", $model->parameter_number_id, array("id" => "active", "class" => "number_type")); ?>
                        <?php echo $model->number_type[$model->parameter_number_id] ?>
                    </div> 
                    <div class="selectable_values">
                        <?php if ((in_array($model->parameter_number_id, array(2, 3))) and ($model->parameter_type_id != 3)) { ?>
                            <div class="master-group-parametrs">
                                <label><?php echo Translater::getDictionary()->catalogmanager_selectableValueTitle ?></label>
                                <?php
                                $k = 0;
                                foreach ($model->selectable as $selectable) {
                                    $selectable->setValue($model->parameter_type_id);
                                    $this->renderPartial('/essence/parameter/_form_selectable_value', array("i" => $k++, "inputname" => "Parameter[$j][Selectable][" . $k . "]", "model" => $selectable));
                                }
                                ?>
                            </div>   
                            <div class="master-group-parametr-add" >
                                <div class="form-row clearfix">
                                    <div class="input-border">
                                        <input id="add_selectable_value_input" type="text" value="" />
                                    </div>
                                    <a class="add_selectable_value_input_button add-group-parametr"><?php echo Translater::getDictionary()->button_add ?></a>
                                </div>				
                            </div> 
                        <?php } ?>
                    </div>       
                    <?php
                }
            }
            $st = $model->isNewRecord ? "new" : "edit";
            $blockButton = array(
                array("name" => Translater::getDictionary()->button_cansel, "class" => "", "hidden" => false, "action" => false, 'access' => $this->checkAccess("manageObject"), "onclick" => "canselSaveParameter(this)"),
                array("name" => Translater::getDictionary()->button_ok, "class" => "", "hidden" => false, "action" => false, "access" => $this->checkAccess("manageObject"), "onclick" => "SaveParameter(this,'$st')"),
            );
            $this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => "right-position"));
            ?>
        </div>    
    </div>
        
    <?php
    $adparameter = array();
    $class = "empty_parent_area";
    if ($model->parameter_work_id == 2) {
        if (!empty($model->group)) {
            $adparameter = $model->group;
            $class = "";
        }
    } else if ($model->parameter_work_id == 3) {
        if (!empty($model->slave)) {
            $adparameter = $model->slave;
            $class = "";
        }
    }
    ?>
        
    <ul id="<?php echo $model->parameter_id; ?>" class="sortable parent_parametr_area <?php echo $class; ?>">
        <?php
        foreach ($adparameter as $param) {
            $this->renderPartial("/essence/parameter/_form", array("model" => $param));
        }
        ?> 
    </ul>
</li>
