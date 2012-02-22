<?php
/* available class for li button
  table-action-add
  table-action-edit
  table-action-delete
 */
?>

<ul class="table-action-buttons">   
    <?php
    $i = 0;
    foreach ($actions as $action) {
        if ($action["access"]) {
            ?>
            <li class="<?php echo $action["class"] . " ";
            echo $i == 0 ? "first-list-item" : ""; ?>">
                <a  <?php if ($action["action"]) { ?>
                        href="<?php echo $action["action"] ?>"  
                    <?php } ?>
                    title="<?php echo $action["title"] ?>" 
                    <?php if ($action["onclick"]) { ?>
                        onclick="<?php echo $action["onclick"] ?>;"  
                    <?php } ?>
                    ></a>
            </li>
            <?php
            $i++;
        }
    }
    ?>
</ul>