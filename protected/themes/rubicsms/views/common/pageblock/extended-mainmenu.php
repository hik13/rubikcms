<?php
$numRow=ceil(count($modules)/3);
$j=0;
?>
<div class="extended-main-menu rounded-corners-10px box-shadow-10px">
    <div class="extended-main-menu-pointer"></div>
    <a id="modul-menu-close" class="extended-main-menu-close "></a>
    <ul class="extended-menu-list clearfix">
        <?php for ($i=1;$i<=3;$i++) { 
            $jnow=$j;
            ?> 
            <div class="extended-mainmenu-column-<?php echo $i ?>">
                <?php  for ($j = $jnow; $j < $i * $numRow; $j++) { 
                    if (!empty($modules[$j])) {
                    ?>
                    <li>
                        <a class="<?php echo $modules[$j]["class"] ?>" href="<?php echo $modules[$j]["defaultCntrl"]; ?>">
                            <div>
                                <?php echo Translater::getDictionary()->{$modules[$j]["module_name"]}; ?>
                            </div>
                        </a>
                    </li>
                <?php  
                    }
                } ?>							
            </div>
        <?php } ?>
    </ul>	
</div>