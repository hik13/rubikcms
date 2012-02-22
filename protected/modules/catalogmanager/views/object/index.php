<?php
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('catalogmanager.resourse.js') . '/list.js'), CClientScript::POS_HEAD);



if (get_class($this->model) == "Category") {
    if ($this->model->category_id) {
        $this->addBreadcrumb(array(array("name" => $this->model->category_name, "action" => $this->createUrl("/catalogmanager/object/index/", array("catalog" => $catalog->catalog_id, "typeobject" => "category", "id" => $this->model->category_id)))));
        $commands = array(
                          array("name" => Translater::getDictionary()->catalogmanager_buttonEditCategory, "action" => $this->createUrl("/catalogmanager/object/update/", array("catalog" => $catalog->catalog_id,"typeobject" => "category", "id" => $this->model->category_id)), "class" => "simple-button", "access" => $this->checkAccess("manageObject")),
                          array("name" => Translater::getDictionary()->catalogmanager_buttonAddCategory, "action" => $this->createUrl("/catalogmanager/object/create/", array("catalog" => $catalog->catalog_id,"typeobject" => "category", "parent_id" => $this->model->category_id)), "class" => "add-button", "access" => $this->checkAccess("manageObject")),
                          array("name" => Translater::getDictionary()->catalogmanager_buttonAddEssence, "action" => $this->createUrl("/catalogmanager/object/create/", array("catalog" => $catalog->catalog_id, "typeobject" => "essence", "parent_id" => $this->model->category_id)), "class" => "add-button", "access" => $this->checkAccess("manageObject"))
                );
 $blockButton = array(
    array("name" => Translater::getDictionary()->catalogmanager_buttonEditCategory, "class"=>"","hidden" => false,"action"=> $this->createUrl("/catalogmanager/object/update/", array("catalog" => $catalog->catalog_id,"typeobject" => "category", "id" => $this->model->category_id)), "access"=>$this->checkAccess("manageObject"),"onclick" => false),
    array("name" => Translater::getDictionary()->catalogmanager_buttonAddCategory, "class"=>"green","hidden" => false,"action"=> $this->createUrl("/catalogmanager/object/create/", array("catalog" => $catalog->catalog_id,"typeobject" => "category", "parent_id" => $this->model->category_id)), "access"=>$this->checkAccess("manageObject"),"onclick" => false),
    array("name" => Translater::getDictionary()->catalogmanager_buttonAddEssence, "class"=>"green","hidden" => false,"action"=> $this->createUrl("/catalogmanager/object/create/", array("catalog" => $catalog->catalog_id, "typeobject" => "essence", "parent_id" => $this->model->category_id)), "access"=>$this->checkAccess("manageObject"),"onclick" => false),  
);

        
    } else { 
        $blockButton = array(
            array("name" => Translater::getDictionary()->catalogmanager_buttonAddCategory, "class" => "green", "hidden" => false, "action" => $this->createUrl("/catalogmanager/object/create/", array("catalog" => $catalog->catalog_id, "typeobject" => "category", "parent_id" => 0)), "access" => $this->checkAccess("manageObject"), "onclick" => false),
            array("name" => Translater::getDictionary()->catalogmanager_buttonAddEssence, "class" => "green", "hidden" => false, "action" => $this->createUrl("/catalogmanager/object/create/", array("catalog" => $catalog->catalog_id, "typeobject" => "essence", "parent_id" => 0)), "access" => $this->checkAccess("manageObject"), "onclick" => false),
        );
}
}
if (get_class($this->model) == "Essence") {
    if ($this->model->essence_id) {
        $this->addBreadcrumb(array(array("name" => $this->model->essence_name, "action" => $this->createUrl("/catalogmanager/object/index/", array("catalog" => $catalog->catalog_id, "typeobject" => "essence", "id" => $this->model->essence_id)))));
        
       $blockButton = array(
            array("name" => Translater::getDictionary()->catalogmanager_buttonEditEssence, "class" => "", "hidden" => false, "action" => $this->createUrl("/catalogmanager/object/update/", array("catalog" => $catalog->catalog_id,"typeobject" => "essence", "id" => $this->model->essence_id)), "access" => $this->checkAccess("manageObject"), "onclick" => false),
            array("name" => Translater::getDictionary()->catalogmanager_buttonAddItem, "class" => "green", "hidden" => false, "action" => $this->createUrl("/catalogmanager/object/create/", array("catalog" => $catalog->catalog_id,"typeobject" => "item", "parent_id" => $this->model->essence_id)), "access" => $this->checkAccess("manageObject"), "onclick" => false),
        );
    }
}
$blockButton[]=array("name" => Translater::getDictionary()->button_deleteSelected, "class" => "red","hidden" =>false, "action" => false, "access" => $this->checkAccess("manageObject"), "onclick" => "$('#catalog_form').submit();");
$this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));
?>
<h1> <?php echo $catalog->catalog_name?> <?php echo $this->model_name?" | ".$this->model_name:""?></h1>
<table class="draggable-table">
    <thead>
        <tr class="table-header">
            <td class="table-cell-no-width thead-checkbox">
                <input type="checkbox" onclick='checkitAll(this,"table")'>
            </td>
            <td class="site-structure-column"><?php echo Translater::getDictionary()->catalogmanager_tableNameObject ?></td>						
            <td class="thead-actions"><?php echo Translater::getDictionary()->catalogmanager_tableAction ?></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="no-padding" colspan="6">
                <form id="catalog_form" action="<?php echo $this->createUrl("/catalogmanager/object/delete/") ?>" method="post">
                    <?php
                    $this->renderPartial('list', array('models' => $models, 'class' => "tree-module-list clearfix"));
                    ?>
                </form>  
            </td>
        </tr>
    </tbody>
</table> 
