<?php
if ((!$adminka)) {
    Yii::app()->clientScript->registerCssFile(Yii::app()->getTheme()->getBaseUrl() . '/css/admin-toolbar.css');
}
if ($adminka) {
    $go = array("link" => "/", "title" => Translater::getDictionary()->admintoolbarToSite);
} else {
    $go = array("link" => "/login", "title" => Translater::getDictionary()->admintoolbarToAdmin);
}
?>
<div class="admin-toolbar">
    <div class="section">
        <div class="sub-section clearfix">
            <a href="/logout" class="logout"><?php echo Translater::getDictionary()->avtorisationLogout ?></a>
            <div class="current-user"><?php echo Yii::app()->user->name ?></div>    
            <?php
            Yii::import("application.modules.translatemanager.models.Language", true);
            $locals = Language::model()->getTranslateVersion();
            ?>           
            <ul class="cms-language-select">
                <?php foreach ($locals as $key => $local) {
                    if ($key == Setting::in()->backendLocale) { ?>
                        <li class="cms-active-language"> 
                            <a><?php echo $local ?></a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="<?php echo$_SERVER["REDIRECT_URL"] . "?interfaceLocale=" . $key ?>"><?php echo $local ?></a>
                        </li>
                    <?php } ?>

                <?php } ?> 

            </ul>
            <a href="<?php echo$_SERVER["REDIRECT_URL"] . "?clearCache=true"?>" class="cms-go-to-system"><?php echo Translater::getDictionary()->clearCache;?></a>
            <a href="<?php echo $go["link"] ?>" class="cms-go-to-system"><?php echo $go["title"] ?></a>
            <?php if ((!$adminka) && ($this->array["model"]->content_id)) { ?>
                <a href="/management/contentmanager/content/update/id/<?php echo $this->array["model"]->content_id ?>/" class="cms-go-to-edit"><?php echo Translater::getDictionary()->button_edit ?></a>
            <?php } ?>
        </div>
    </div>
</div>
