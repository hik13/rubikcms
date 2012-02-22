<?php
/* available class for td
  table-cell-no-width
  thead-number
  thead-title
  thead-description
  thead-actions
  thead-checkbox
  site-structure-column
  thead-date
  thead-author
 */


if (count($header) != count($body[0]) and count($body[0]) > 0) {
    echo "Количество колонок в header не совподает с количеством колонок в body<br/>";
    echo "Проверьте код вызывающего файла";
} else {
    ?>
    <table <?php echo $tclass ? "class='" . $tclass . "'" : ""; ?> id="<?php echo $tid ?>">   
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
            <?php
            if ($body) {
                $class = "light-row";
                foreach ($body as $key => $tr) {
                    $class = $class == "light-row" ? "dark-row" : "light-row";
                    ?>
                    <tr id="<?php echo $key ?>" class="<?php echo $class; ?>">
                        <?php
                        foreach ($tr as $key => $td) {
                            if (is_array($td)) {
                                if ($td["sortable"]) {
                                    ?>
                                    <td class="tabledrag-handle-2"></td> 
                                <?php }
                            } else { ?>
                                <td><?php echo $td ?></td>
                                <?php
                            }
                        }
                        ?>
                    </tr>
        <?php }
    } ?>
        </tbody>
    </table>
<?php } ?>