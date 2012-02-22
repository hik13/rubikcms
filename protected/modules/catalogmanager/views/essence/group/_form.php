<?php
$inputs = array(
    array("type" => "hidden",
        "input" => CHtml::hiddenField("Group[$i][group_id]", $model->group_id),
    ),
    array("type" => "hidden",
        "input" => CHtml::hiddenField("Group[$i][temp_group_id]", $model->getGroupId(), array("class" => "group_id")),
    ),
    array("type" => "textfield",
        "label" => CHtml::activelabel($model, "group_name"),
        "input" => CHtml::textField("Group[$i][group_name]", $model->group_name, array('size' => 60, 'maxlength' => 300, "class" => "inputNameGroup")),
    ),
);
?>
    
<li id="<?php echo $i; ?>" class="catalog-group-li">
    <div class="menu-item active-item clearfix">	
        <div class="section-title" 
        <?php if ($model->isNewRecord) { ?>
                 style="display:none"
             <?php } ?>
             >				
            <div class="inner-border clearfix">					
                <ul class="table-action-buttons clearfix">						
                    <li class="table-action-add">
                        <a title="<?php echo Translater::getDictionary()->button_add ?>" class="addParameter"></a>
                    </li>						
                    <li class="table-action-delete">
                        <a title="<?php echo Translater::getDictionary()->button_delete ?>" onclick="deleteEssenseObject($(this).parents('.catalog-group-li'),<?php echo $model->isNewRecord ? "true" : "false" ?>,'Group',<?php echo $model->isNewRecord ? "0" : $model->group_id ?>)"></a>
                    </li>					
                </ul>					
                <a class="form-button" onclick="showGroupNameForm(this)"><?php echo $model->group_name ?></a>				
            </div>			
        </div>
        <div class="catalog-edit-form"
        <?php if (!$model->isNewRecord) { ?>
                 style="display:none"
             <?php } ?>
             >				
            <div class="catalog-edit-pointer">
            </div>		
            <?php
            $this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs));
            $st = $model->isNewRecord ? "new" : "edit";
            $blockButton = array(
                array("name" => Translater::getDictionary()->button_cansel, "class" => "", "hidden" => false, "action" => false, 'access' => $this->checkAccess("manageObject"), "onclick" => "canselSaveGroup(this)"),
                array("name" => Translater::getDictionary()->button_ok, "class" => "", "hidden" => false, "action" => false, "access" => $this->checkAccess("manageObject"), "onclick" => "SaveGroup(this,'$st')"),
            );
            $this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => "right-position"));
            ?>	
        </div>
            
    </div>
    <ul id="<?php echo $i; ?>" class="sortable parameter_area">
        <?php
        if (count($model->parameters) > 0) {
            foreach ($model->parameters as $parameter) {
                $this->renderPartial("/essence/parameter/_form", array("model" => $parameter, "i" => $i));
            }
        }
        ?> 
    </ul>     
</li>












