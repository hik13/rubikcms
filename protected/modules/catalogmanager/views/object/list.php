<?php
$count = count($models);
$class_div = array("zero" => "simple", "minus" => "opened", "plus" => "closed");
$vloj = $vloj > 0 ? $vloj : 0;
$padding = $vloj * 40;
if ($padding > 0) {
    $stylePad = "style=\"padding-left:" . $padding . "px;\"";
} else {
    $stylePad = "";
}
?>

<ul  rel="<?php echo $vloj ?>"  class="ul_sort draggable-list <?php echo $class ?>">
    <?php
    $i = 0;
    if ($count > 0)
        foreach ($models as $model) {
            if ($model instanceof Category) {
                $child = array_merge($model->cat, $model->essence);
                $dcdKey = count($child) > 0 ? "minus" : "zero";
                ?>
                <li>
                    <table>
                        <tbody>
                            <tr>
                                <td class="table-cell-no-width thead-checkbox">
                                    <input value="<?php echo $model->category_id ?>" type="checkbox" name="Deleteobject[<?php echo $i ?>][id]"/>
                                    <input value="category" type="hidden" name="Deleteobject[<?php echo $i ?>][type]"/>
                                </td>
                                <td class="site-structure-column" <?php echo $stylePad; ?> >
                                    <div class="tabledrag-handle"></div>			
                                    <a class="status tabletree-toggle-btn <?php echo $class_div[$dcdKey]; ?>"></a>			
                                    <a href="<?php echo $this->createUrl("/catalogmanager/object/index/", array("catalog" => $model->category_catalog_id, "typeobject" => "category", "id" => $model->category_id)) ?>" ><?php echo $model->category_name ?></a>
                                </td>
                                <td class="thead-actions">
                                    <ul class="table-action-buttons">
                                        <li class="table-action-add first-list-item">
                                            <a title="<?php echo Translater::getDictionary()->catalogmanager_buttonAddCategory ?>" href="<?php echo $this->createUrl("/catalogmanager/object/create/", array("catalog" => $model->category_catalog_id, "typeobject" => "category", "parent_id" => $model->category_id)) ?>/" class="add-button"></a>
                                        </li>
                                        <li class="table-action-add ">
                                            <a title="<?php echo Translater::getDictionary()->catalogmanager_buttonAddEssence ?>" href="<?php echo $this->createUrl("/catalogmanager/object/create/", array("catalog" => $model->category_catalog_id, "typeobject" => "essence", "parent_id" => $model->category_id)) ?>/" class="add-button"></a>
                                        </li>
                                        <li class="table-action-edit">
                                            <a title="<?php echo Translater::getDictionary()->button_edit ?>" href="<?php echo $this->createUrl("/catalogmanager/object/update/", array("catalog" => $model->category_catalog_id, "typeobject" => "category", "id" => $model->category_id)) ?>/" class="edit-button"></a>
                                        </li>
                                        <li class="table-action-delete">
                                            <a title="<?php echo Translater::getDictionary()->button_delete ?>" href="<?php echo $this->createUrl("/catalogmanager/object/delete/", array("catalog" => $model->category_catalog_id, "typeobject" => "category", "id" => $model->category_id)) ?>" class="delete-button" onclick="return confirmdelete();"></a>
                                        </li>
                                    </ul>							
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?php
                    $models = array_merge($model->cat, $model->essence);
                    $addclass = count($models) > 0 ? "" : "empty-tree-list";
                    $this->renderPartial('list', array('models' => $models, "class" => $addclass, "vloj" => $vloj + 1,));
                    ?>
                </li>
            <?php } else if ($model instanceof Essence) { ?>
                <li >
                    <table>
                        <tbody>
                            <tr>
                                <td class="table-cell-no-width thead-checkbox">
                                    <input value="<?php echo $model->essence_id ?>" type="checkbox" name="Deleteobject[<?php echo $i ?>][id]"/>
                                    <input value="essence" type="hidden" name="Deleteobject[<?php echo $i ?>][type]"/>  
                                </td>
                                <td class="site-structure-column" <?php echo $stylePad; ?> >
                                    <div class="tabledrag-handle"></div>			
                                    <a class="status tabletree-toggle-btn simple"></a>			
                                    <a href="<?php echo $this->createUrl("/catalogmanager/object/index/", array("catalog" => $model->essence_catalog_id, "typeobject" => "essence", "id" => $model->essence_id)) ?>" >
                                        <?php echo $model->essence_name ?>
                                    </a>
                                </td>
                                <td class="thead-actions">
                                    <ul class="table-action-buttons">
                                        <li class="table-action-add first-list-item">
                                            <a title="<?php echo Translater::getDictionary()->catalogmanager_buttonAddItem ?>" href="<?php echo $this->createUrl("/catalogmanager/object/create/", array("catalog" => $model->essence_catalog_id, "typeobject" => "item", "parent_id" => $model->essence_id)) ?>/" class="add-button"></a>                               
                                        </li>
                                        <li class="table-action-edit">
                                            <a title="<?php echo Translater::getDictionary()->button_edit ?>" href="<?php echo $this->createUrl("/catalogmanager/object/update/", array("catalog" => $model->essence_catalog_id, "typeobject" => "essence", "id" => $model->essence_id)) ?>/" class="edit-button"></a>
                                        </li>
                                        <li class="table-action-delete">
                                            <a title="<?php echo Translater::getDictionary()->button_delete ?>" href="<?php echo $this->createUrl("/catalogmanager/object/delete/", array("catalog" => $model->essence_catalog_id, "typeobject" => "essence", "id" => $model->essence_id)) ?>" class="delete-button" onclick="return confirmdelete();"></a>
                                        </li>
                                    </ul>							
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </li>
            <?php } else if ($model instanceof Item) { ?>
                <li >
                    <table>
                        <tbody>
                            <tr>
                                <td class="table-cell-no-width thead-checkbox">
                                    <input value="<?php echo $model->item_id ?>" type="checkbox" name="Deleteobject[<?php echo $i ?>][id]" />
                                    <input value="item" type="hidden" name="Deleteobject[<?php echo $i ?>][type]" />  
                                </td>
                                <td class="site-structure-column" <?php echo $stylePad; ?> >
                                    <div class="tabledrag-handle"></div>			
                                    <a class="status tabletree-toggle-btn simple"></a>			
                                    <a>
                                        <?php echo $model->item_name ?>
                                    </a>
                                </td>
                                <td class="thead-actions">
                                    <ul class="table-action-buttons">
                                        <li class="table-action-edit first-list-item">
                                            <a title="<?php echo Translater::getDictionary()->button_edit ?>" href="<?php echo $this->createUrl("/catalogmanager/object/update/", array("catalog" => $this->model->essence_catalog_id, "typeobject" => "item", "id" => $model->item_id)) ?>/" class="edit-button"></a>
                                        </li>
                                        <li class="table-action-delete">
                                            <a title="<?php echo Translater::getDictionary()->button_delete ?>" href="<?php echo $this->createUrl("/catalogmanager/object/delete/", array("catalog" => $this->model->essence_catalog_id, "typeobject" => "item", "id" => $model->item_id)) ?>" class="delete-button" onclick="return confirmdelete();"></a>
                                        </li>
                                    </ul>							
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </li>

                <?php
            }
            $i++;
        }
    ?>
</ul>