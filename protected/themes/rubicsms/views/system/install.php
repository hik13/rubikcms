<?php
$array_indices = array(
    "choiceLanguage" => array("name" => Translater::getDictionary()->choiceInterfaceLanguage),
    "setUser" => array("name" => Translater::getDictionary()->setSystemAdmin),
    "setDb" => array("name" => Translater::getDictionary()->setSettingDB),
    "setConfig" => array("name" => Translater::getDictionary()->setConfigFile),
    "finish" => array("name" => Translater::getDictionary()->setFinish),
);




switch ($setTo) {
    case "choiceLanguage" : {
            $array_indices["choiceLanguage"]["active"] = true;
            $mainTitle = $array_indices["choiceLanguage"]["name"];
            $fields = array(array("label" => Translater::getDictionary()->labelSetLocale, "input" => CHtml::dropDownList("SET[locale_id]", Yii::app()->user->getState("install[locale_id]"), $locales), "border" => false));
            break;
        }
    case "setUser" : {
            $array_indices["setUser"]["active"] = true;
            $mainTitle = $array_indices["setUser"]["name"];
            $fields = array(
                array("label" => Translater::getDictionary()->labelSetUserLogin, "input" => CHtml::textField("SET[user_login]", Yii::app()->user->getState("install[user_login]")), "border" => true),
                array("label" => Translater::getDictionary()->labelSetUserPass, "input" => CHtml::passwordField("SET[user_pass]", Yii::app()->user->getState("install[user_pass]")), "border" => true),
            );
            break;
        }
    case "setDb" : {
            $array_indices["setDb"]["active"] = true;
            $mainTitle = $array_indices["setDb"]["name"];
            if (in_array(Yii::app()->user->getState("install[db_host]"), array("", "localhost"))) {
                $db_host = "localhost";
            } else {
                $db_host = Yii::app()->user->getState("install[db_host]");
            }
            $fields = array(
                array("label" => Translater::getDictionary()->labelSetDbHost, "input" => CHtml::textField("SET[db_host]", $db_host), "border" => true),
                array("label" => Translater::getDictionary()->labelSetDbName, "input" => CHtml::textField("SET[db_name]", Yii::app()->user->getState("install[db_name]")), "border" => true),
                array("label" => Translater::getDictionary()->labelSetDbUser, "input" => CHtml::textField("SET[db_login]", Yii::app()->user->getState("install[db_login]")), "border" => true),
                array("label" => Translater::getDictionary()->labelSetDbPass, "input" => CHtml::textField("SET[db_pass]", Yii::app()->user->getState("install[db_pass]")), "border" => true),
            );
            break;
        }
    case "setConfig" : {
            $array_indices["setConfig"]["active"] = true;
            $mainTitle = $array_indices["setConfig"]["name"];
            $fields = array(
                array("label" => Translater::getDictionary()->labelSetTheme, "input" => CHtml::dropDownList("SET[theme]", Yii::app()->user->getState("install[theme]"), $themes), "border" => false),
            );
            break;
        }


    case "finish" : {
            $array_indices["finish"]["active"] = true;
            $mainTitle = $array_indices["finish"]["name"];
            $fields = array();
            break;
        }
}
?>



<div class="authorization-header">
    <div class="sub-section">
        <div class="autorization-section install-section clearfix">
            <a class="logo" href="#"></a>
        </div>
    </div>
</div>
<form action="/install.php" method="POST">
    <div class="install-block">
        <div class="autorization-section install-section clearfix">
            <ul class="install-menu column-30-percent">
                <?php
                foreach ($array_indices as $indices) {
                    $class = $indices["active"] ? "class='active-link'" : "";
                    ?>
                    <li <?php echo $class ?> >
                        <a><?php echo $indices["name"] ?></a>
                    </li>
                <?php } ?>	
            </ul>
            <div class="install-content column-70-percent">
                <div class="padding-left-36px">
                    <div class="sub-section rounded-corners-10px box-shadow-10px">
                        <h1><?php echo $mainTitle ?></h1>
                        <?php if ($block_message) { ?>
                            <div class="<?php echo $block_message["class"] ?>">
                                <div class="title">
                                    <?php echo Translater::getDictionary()->systemMessage ?>
                                </div>
                                <?php echo $block_message["message"] ?>				
                            </div>
                        <?php } ?>
                        <?php foreach ($fields as $field) { ?>
                            <div class="form-row clearfix">					
                                <div class="form-row-item">
                                    <label><?php echo $field["label"]; ?></label>    
                                    <?php if ($field["border"]) { ?>
                                        <div class="input-border">
                                            <?php echo $field["input"] ?>
                                        </div>
                                        <?php
                                    } else {
                                        echo $field["input"];
                                    }
                                    ?>    
                                </div>				
                            </div>
                        <?php } ?>


                        <ul class="module-action-buttons right-position clearfix">

                            <?php if ($setTo != "finish") { ?>
                                <li class="simple-button">						
                                    <a  onclick="$(this).parents('form').submit()">							
                                        <div class="module-action-button-left"></div>							
                                        <div class="module-action-button-title">
                                            <?php echo Translater::getDictionary()->labelNext; ?>   
                                        </div>							
                                        <div class="module-action-button-right"></div>
                                    </a>
                                </li>
                                <?php
                            }
                            switch ($setTo) {
                                case "choiceLanguage" : {

                                        break;
                                    }
                                case "setUser" : {
                                        ?>
                                        <li class="simple-button">						
                                            <a onclick="$(this).parents('form').append('<input type=\'hidden\' name=\'UNSET[locale_id]\' value=\'true\' />').submit()">							
                                                <div class="module-action-button-left"></div>							
                                                <div class="module-action-button-title">
                                                    <?php echo Translater::getDictionary()->labelBack; ?>       
                                                </div>							
                                                <div class="module-action-button-right"></div>
                                            </a>
                                        </li> 
                                        <?php
                                        break;
                                    }
                                case "setDb" : {
                                        ?>
                                        <li class="simple-button">						
                                            <a onclick="$(this).parents('form').append('<input type=\'hidden\' name=\'UNSET[user_login]\' value=\'true\' /><input type=\'hidden\' name=\'UNSET[user_pass]\' value=\'true\' />').submit()">							
                                                <div class="module-action-button-left"></div>							
                                                <div class="module-action-button-title">
                                                    <?php echo Translater::getDictionary()->labelBack; ?> 
                                                </div>							
                                                <div class="module-action-button-right"></div>
                                            </a>
                                        </li>  
                                        <?php
                                        break;
                                    }

                                case "setConfig" : {
                                        ?>
                                        <li class="simple-button">						
                                            <a onclick="$(this).parents('form').append('<input type=\'hidden\' name=\'UNSET[db_login]\' value=\'true\' /><input type=\'hidden\' name=\'UNSET[installed]\' value=\'true\' /><input type=\'hidden\' name=\'UNSET[theme]\' value=\'true\' />').submit()">							
                                                <div class="module-action-button-left"></div>							
                                                <div class="module-action-button-title">
                                                    <?php echo Translater::getDictionary()->labelBack; ?> 
                                                </div>							
                                                <div class="module-action-button-right"></div>
                                            </a>
                                        </li>  
                                        <?php
                                        break;
                                    }

                                case "finish" : {
                                        ?>
                                        <li class="simple-button green">						
                                            <a href="/login">							
                                                <div class="module-action-button-left"></div>							
                                                <div class="module-action-button-title"><?php echo Translater::getDictionary()->labelGoToLogin; ?> </div>							
                                                <div class="module-action-button-right"></div>
                                            </a>
                                        </li>
                                        <?php
                                        break;
                                    }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


