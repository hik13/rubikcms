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
            $arrayactions = array(
                array("class" => "table-action-add",
                    "action" => $this->createUrl("/contentmanager/content/create/", array("parent_id" => $content["parent"]["content_id"],"locale_id"=>$content["parent"]["locale_id"])),
                    "title" => Translater::getDictionary()->button_add,
                    "onclick" => false,
                    "access" => $this->checkAccess("manageContent")),
                array("class" => "table-action-edit",
                    "action" => $this->createUrl("/contentmanager/content/update/", array("id" => $content["parent"]["content_id"])),
                    "title" => Translater::getDictionary()->button_edit,
                    "onclick" => false,
                    "access" => $this->checkAccess("manageContent")),
                array("class" => "table-action-delete",
                    "action" => $this->createUrl("/contentmanager/content/delete/", array("id" => $content["parent"]["content_id"])),
                    "title" => Translater::getDictionary()->button_delete,
                    "onclick" => 'return confirmdelete()',
                    "access" => $this->checkAccess("manageContent")),
            );
            ?>      
            <li id="<?php echo $content["parent"]["content_id"]; ?>" class="drag<?php echo $disabled ?>">
                <table>
                    <tbody>
                        <tr>
                            <td class="site-structure-column" <?php echo $stylePad; ?> >
                                <div class="tabledrag-handle"></div>			
                                <a class="status tabletree-toggle-btn <?php echo $class_div[$dcdKey]; ?>"></a>			
                                <a href="<?php echo $this->createUrl("/contentmanager/content/update/", array("id" => $content["parent"]["content_id"])) ?>"><?php echo $content["parent"]["name"] ?></a>
                            </td>
                            <td class="thead-date">
                                <?php echo date("d.m.Y - H:i:s", $content["parent"]["edition"]) ?>
                            </td>

                            <td class="thead-author">
                                <?php echo $userList[$content["parent"]["editor_id"]] ?>
                            </td>
                            <td class="table-cell-no-width">
                                <a  class="table-item-status <?php echo $content["parent"]["status_id"] == 1 ? "" : "unpublished" ?> ">
                                </a>
                            </td>
                            <td class="thead-actions">
                                <?php $this->renderPartial("//block/table/table_ul_button", array("actions" => $arrayactions)); ?>
                            </td>
                            <?php if (Setting::in()->countActiveLocale) { ?>
                                <td class="thead-author">
                                    <?php                               
                                    foreach ($locales as $key => $locale) {                                       
                                        if ($key != $content["parent"]["locale_id"]) {
                                            if (is_array($content["relate"])) {
                                                if ($key_id = array_search($key, $content["relate"])) {
                                                    ?>
                                                    <a title="<?php echo Translater::getDictionary()->button_edit ?>" style="color:blue" href="<?php echo $this->createUrl("/contentmanager/content/update/", array("id" => $key_id)) ?>"> <?php echo $locale ?></a>   
                                                <? } else { ?>
                                                    <a title="<?php echo Translater::getDictionary()->button_add ?>" href="<?php echo $this->createUrl("/contentmanager/content/create/", array("locale_id" => $key, "related_content" => $content["parent"]["content_id"])) ?>">
                                                        <?php echo $locale ?></a>
                                                <?php }
                                            } else { ?>
                                                <a  title="<?php echo Translater::getDictionary()->button_add ?>" href="<?php echo $this->createUrl("/contentmanager/content/create/", array("locale_id" => $key)) ?>">
                                                    <?php echo $locale ?></a>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </td>
                            <?php } ?>

                        </tr>
                    </tbody>
                </table>
                <?php
                $addclass = count($content["child"]) > 0 ? "" : "empty-tree-list";
                $this->renderPartial('/redefined/content_tree_table_ul_table', array('contents' => $content["child"], "class" => $addclass, "parent_id" => $content["parent"]["content_id"], "vloj" => $vloj + 1, 'userList' => $userList, "locales" => $locales));
                ?>
            </li>
        <?php } ?>
</ul>