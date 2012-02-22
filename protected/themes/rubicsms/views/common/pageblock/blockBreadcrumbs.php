<div class="bread-crumbs">
    <div class="section">
        <div class="sub-section clearfix">
            <ul class="bread-crumb-list rounded-corners-top-10px sub-section clearfix">
                <li class="bread-crumb-home">
                    <a href=<?php echo $this->createUrl('/contentmanager/') ?>><?php echo Translater::getDictionary()->mainPage ?></a>
                </li>
                <?php if ($crumbs) {
                    for ($i = 0; $i < count($crumbs); $i++) { ?>
                        <li>
                            <?php
                            if ($i == (count($crumbs) - 1)) {
                                echo $crumbs[$i]["name"];
                            } else {
                                ?>
                                <a href="<?php echo $crumbs[$i]["action"] ?>">
                                    <?php echo $crumbs[$i]["name"] ?>
                                </a>
                            </li>
                        <?php
                        }
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>
