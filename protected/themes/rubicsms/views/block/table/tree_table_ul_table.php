<?php
$class_div = array("zero" => "simple", "minus" => "opened", "plus" => "closed");
if ($this->checkAccess("manageContent")) {
    $sort = "ul_sort connectedSortable";
}
$vloj = $vloj > 0 ? $vloj : 0;
$padding = $vloj * 40;

if ($padding > 0) {
    $stylePad = "style=\"padding-left:" . $padding . "px;\"";
} else {
    $stylePad = "";
}
?>
    
<ul rel="<?php echo $vloj ?>" id="<?php echo $parent_id ? $parent_id : 0 ?>" class="draggable-list <?php echo $sort . " " . $class ?>">
    
    <?php
    if (count($contents) > 0)
        foreach ($contents as $content) {
            $disabled = $content["parent"]["status_id"] == 0 ? " disabled" : "";
            $dcdKey = count($content["child"]) > 0 ? "minus" : "zero";
            ?>
                        
            <li id="<?php echo $content["parent"]["content_id"]; ?>" class="drag<?php echo $disabled ?>">
                <table>
                    <tbody>
                        <tr>
                            <td class="table-cell-no-width thead-checkbox">
                                <input type="checkbox">
                            </td>
                            <td class="site-structure-column" <?php echo $stylePad; ?> >
                                <div class="tabledrag-handle"></div>			
                                <a class="status tabletree-toggle-btn <?php echo $class_div[$dcdKey]; ?>"></a>			
                                <a href="<?php echo $this->createUrl("/contentmanager/content/update/", array("id" => $content["parent"]["content_id"])) ?>"><?php echo $content["parent"]["name"] ?></a>
                            </td>
                                
                            <td class="thead-date">
                                <?php echo date("m.d.Y - H:i:s", $content["parent"]["edition"]) ?>
                            </td>
                                
                            <td class="thead-author">
                                <?php echo $users[$content["parent"]["editor_id"]] ?>
                            </td>
                            <td class="table-cell-no-width"><a  class="table-item-status <?php echo $content["parent"]["status_id"] == 1 ? "" : "unpublished" ?> " title="Опубликован"></a></td>
                            <td class="thead-actions">
                                <?php if ($this->checkAccess("manageContent")) { ?>
                                    <ul class="table-action-buttons">
                                        <li class="table-action-add first-list-item"><a href="<?php echo $this->createUrl("/contentmanager/content/create/", array("id" => $content["parent"]["content_id"])) ?>/" title="<?php echo Translater::getDictionary()->button_add ?>"></a></li>
                                        <li class="table-action-edit"><a href="<?php echo $this->createUrl("/contentmanager/content/update/", array("id" => $content["parent"]["content_id"])) ?>/" title="<?php echo Translater::getDictionary()->button_edit ?>"></a></li>
                                        <li class="table-action-delete"><a title="<?php echo Translater::getDictionary()->button_delete ?>" href="<?php echo $this->createUrl("/contentmanager/content/delete/", array("id" => $content["parent"]["content_id"])) ?>" onclick='return confirmdelete()'></a></li>
                                    </ul>	
                                <?php } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php
                $addclass = count($content["child"]) > 0 ? "" : "empty-tree-list";
                $this->renderPartial('list', array('contents' => $content["child"], "class" => $addclass, "parent_id" => $content["parent"]["content_id"], "vloj" => $vloj + 1, 'users' => $users));
                ?>
            </li>
        <?php } ?>
</ul>
