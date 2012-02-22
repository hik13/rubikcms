<?php $active_class_li = "module-main-menu-active-tab";
if ($punkts) { ?>
    <div class="module-main-menu">
        <ul class="clearfix">
            <?php
            foreach ($punkts as $key => $punkt) {
                if ($punkt["access"]) {
                    $active_li = (is_array($punkt["controller"]) && ((in_array($this->id, $punkt["controller"])))) ||
                            ($this->id == $punkt["controller"]) || ($punkt["active_t"]);
                    ?>
                    <li <?php echo $active_li ? "class='" . $active_class_li . "'" : "" ?>>

                        <?php if (!$active_li) { ?>    <a href="<?php echo $punkt["action"] ?>"> <?php } ?>
                            <div class="module-main-menu-tab-left"></div>
                            <div class="module-main-menu-tab-center"><?php echo $punkt["name"] ?></div>
                            <div class="module-main-menu-tab-right"></div>
                            <?php if (!$active_li) { ?>    </a> <?php } ?>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
<?php } ?>