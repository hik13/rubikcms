<?php 
/*
available class-colors for button
green
red
*/
?>
<ul class="module-action-buttons clearfix <?php echo $additional_class_ul ?>">
    <?php foreach ($buttons as $button) {
        if ($button["access"]) { ?>
            <li class="simple-button <?php echo $button["class"]; ?>" 
            <?php if ($button["hidden"]) { ?>
                    style="display:none"
                <?php } ?>
                >
                <a <?php if ($button["action"]) { ?>
                        href="<?php echo $button["action"] ?>"
                    <?php } ?>
                    <?php if ($button["onclick"]) { ?>
                        onclick="<?php echo $button["onclick"] ?>"
                    <?php } ?>           
                    >
                    <div class="module-action-button-left"></div>
                    <div class="module-action-button-title"> <?php echo $button["name"] ?></div>
                    <div class="module-action-button-right"></div>
                </a>
            </li>
        <?php
        }
    }
    ?>
</ul>
