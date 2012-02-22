<?php
function getClass($href) {
 $pos=strpos(Yii::app()->request->requestUri,$href);
 return $pos===false?"":"active-tab";
}
?>


<ul class="main-menu">
    <?php foreach ($modules as $modul) {
        ?>
        <li class="<?php echo $modul["class"] . " " . getClass($modul["defaultCntrl"]); ?>">
            <div class="main-menu-tab-left"></div>
            <div class="main-menu-tab-center">
                <a <?php echo!getClass($modul["defaultCntrl"]) ? 'href="' . $modul["defaultCntrl"] . '"' : ""; ?>><?php echo Translater::getDictionary()->{$modul["module_name"]}; ?></a>
            </div>
            <div class="main-menu-tab-right"></div>
        </li>
    <?php } ?>
</ul>
