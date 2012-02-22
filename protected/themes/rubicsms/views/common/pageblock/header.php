

<?php   $modulesFT = Yii::app()->db->createCommand()
        ->select('module_id,module_name,defaultCntrl,class')
        ->from("module")
        ->order("module_order")
        ->queryAll();
foreach ($modulesFT as $modul) {
    if (in_array($modul["module_id"], Yii::app()->user->permission["module_id"])) {
        $modul["defaultCntrl"]=Yii::app()->createUrl($modul["defaultCntrl"]);
        $modules[] = $modul;
    }
}

?>
<div class="header">
    <div class="section">
        <div class="sub-section clearfix">
            <div class="header-bg sub-section clearfix rounded-corners-10px box-shadow-10px">													
                <a id="extended-menu-bar" class="logo-button" href="#"></a>					
                <?php $this->renderPartial('//common/pageblock/extended-mainmenu', array("modules"=>$modules)); ?>
                <?php $this->renderPartial('//common/pageblock/mainmenu',array("modules"=>$modules)); ?>                   					
            </div>
        </div>  
    </div>
</div>
