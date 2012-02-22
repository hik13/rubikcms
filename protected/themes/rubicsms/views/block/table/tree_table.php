<table class="draggable-table <?php echo $tclass ?>" id="<?php echo $tid ?>">
    <thead>
        <tr class="table-header">
            <?php
            foreach ($header as $td) {
                $td["class"] = $td["sortable"] ? $td["class"] . " sort" : $td["class"];
                ?>
                <td <?php echo $td["class"] ? "class='" . $td["class"] . "'" : ""; ?>>
                    <?php if ($td["sortable"]) { ?>
                        <a href="#">
                            <div  <?php echo $td["sort_now"] ? "class='sort-up'" : "" ?>> <?php echo $td["value"]; ?></div>
                        </a>
                        <?php
                    } else {
                        echo $td["value"];
                    }
                    ?>
                </td>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="<?php echo count($header) ?>" class="no-padding">
                <ul class="draggable-list ul_sort connectedSortable tree-module-list  ui-sortable clearfix">   
                    <li class="drag">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="table-cell-no-width thead-checkbox">
                                        <input type="checkbox">
                                    </td>
                                    <td class="site-structure-column">
                                        <div class="tabledrag-handle"></div>			
                                        <a class="status tabletree-toggle-btn simple"></a>			
                                        <a href="/management/contentmanager/content/update/id/155">Главная</a>
                                    </td>

                                    <td class="thead-date">09.23.2011 - 13:57:30</td>

                                    <td class="thead-author"></td>

                                    <td class="table-cell-no-width">
                                        <a title="Опубликован" class="table-item-status"></a>
                                    </td>

                                    <td class="thead-actions">
                                        <ul class="table-action-buttons">
                                            <li class="table-action-add first-list-item"><a title="Add" href="#"></a></li>
                                            <li class="table-action-edit"><a title="Edit" href="#"></a></li>
                                            <li class="table-action-delete"><a href="#" title="Delete"></a></li>
                                        </ul>	
                                    </td>
                                </tr>
                            </tbody>
                        </table>                 
                        <ul class="draggable-list ul_sort connectedSortable empty-tree-list ui-sortable">
                        </ul>
                    </li>

                    <li class="drag">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="table-cell-no-width thead-checkbox">
                                        <input type="checkbox">
                                    </td>

                                    <td class="site-structure-column">
                                        <div class="tabledrag-handle"></div>			
                                        <a class="status tabletree-toggle-btn opened"></a>			
                                        <a href="#">Компания</a>
                                    </td>   

                                    <td class="thead-date">
                                        09.01.2011 - 15:46:41
                                    </td>

                                    <td class="thead-author">
                                        Админ
                                    </td>

                                    <td class="table-cell-no-width">
                                        <a title="Опубликован" class="table-item-status  "></a>
                                    </td>

                                    <td class="thead-actions">
                                        <ul class="table-action-buttons">
                                            <li class="table-action-add first-list-item"><a title="Add" href="#"></a></li>
                                            <li class="table-action-edit"><a title="Edit" href="#"></a></li>
                                            <li class="table-action-delete"><a href="#" title="Delete"></a></li>
                                        </ul>	
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <ul class="draggable-list ul_sort connectedSortable  ui-sortable">
                            <li class="drag">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="table-cell-no-width thead-checkbox">
                                                <input type="checkbox">
                                            </td>
                                            <td style="padding-left:40px;" class="site-structure-column">
                                                <div class="tabledrag-handle"></div>			
                                                <a class="status tabletree-toggle-btn simple"></a>			
                                                <a href="#">О компании</a>
                                            </td>

                                            <td class="thead-date">
                                                10.31.2011 - 13:58:46
                                            </td>

                                            <td class="thead-author">Админ</td>

                                            <td class="table-cell-no-width">
                                                <a title="Опубликован" class="table-item-status  "></a>
                                            </td>

                                            <td class="thead-actions">
                                                <ul class="table-action-buttons">
                                                    <li class="table-action-add first-list-item"><a title="Add" href="#"></a></li>
                                                    <li class="table-action-edit"><a title="Edit" href="#"></a></li>
                                                    <li class="table-action-delete"><a href="#" title="Delete"></a></li>
                                                </ul>	
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <ul class="draggable-list ul_sort connectedSortable empty-tree-list ui-sortable"></ul>
                            </li>                            
                        </ul>
                    </li>
                </ul>
                </form>
            </td>
        </tr>
    </tbody>
</table>
