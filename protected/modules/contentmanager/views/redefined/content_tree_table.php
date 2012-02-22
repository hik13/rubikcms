<table class="draggable-table <?php echo $tclass ?>" id="<?php echo $tid ?>">
    <thead>
        <tr class="table-header">
            <?php foreach ($header as $td) { ?>
                <td <?php echo $td["class"] ? "class='" . $td["class"] . "'" : ""; ?>>
                    <?php echo $td["value"]; ?>
                </td>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="<?php echo count($header) ?>" class="no-padding">
                <?php $this->renderPartial('/redefined/content_tree_table_ul_table', array("header"=>$header,'contents' => $content, 'class' => "tree-module-list clearfix", "vloj" => 0, "userList" => $userList, "parent_id" => false,"locales" =>$locales)) ?>
            </td>
        </tr>
    </tbody>
</table>

