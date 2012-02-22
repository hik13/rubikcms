<?php Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('seomanager.resourse.js') . '/seo.js'), CClientScript::POS_HEAD); ?>
<h1><?php echo Translater::getDictionary()->seoIndexTitle ?></h1>
<form id="seo_form" action="<?php echo $this->createUrl("/seomanager/seo/index/") ?>" method="post">
    <?php
    $i = 0;
    foreach ($seo as $model) {
        if ($model->seo_key != "seoCounters") {
            $inputs = array(
                array(
                    "type" => "hidden",
                    "input" => CHtml::hiddenField("Seo[$i][seo_id]", $model->seo_id)),
                array(
                    "type" => "textarea",
                    "label" => CHtml::label(Translater::getDictionary()->{$model->seo_key}, "seo_" . $model->seo_id),
                    "input" => CHtml::textArea("Seo[$i][seo_text]", $model->seo_text, array("rows" => 7))));
            $this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs));
        } else { ?>
            <div id="counters" rel="<?php echo $i; ?>">
                <?php
                echo CHtml::hiddenField("Seo[$i][seo_id]", $model->seo_id);
                echo CHtml::label(Translater::getDictionary()->{$model->seo_key}, "seo_" . $model->seo_id);
                $j = 0;
                $locale = Locale::getLocaleList(Array("key" => "locale_id", "value" => "locale_description"));
                foreach ($model->counters as $counter) {
                    $this->renderPartial("_form_counter", array("model" => $counter,"i"=>$i ,"j" => $j++, "locale" => $locale, "ajax" => false));
                }
                ?>
            </div>   
            <div class="form-row clearfix">
                <div class="form-row-item">
                    <a id="addCounter" class="catalog-add-new-group"><?php echo Translater::getDictionary()->addCounter ?></a>  
                </div>
            </div>
            <?php
        }
        $i++;
    }

    $blockButton = array(
        array("name" => Translater::getDictionary()->button_save, "class" => "", "action" => false, "hidden" => false, 'access' => $this->checkAccess("manageSeo"), "onclick" => "$(this).parents('form').submit();"),
        array("name" => Translater::getDictionary()->button_cansel, "class" => "red", "action" => $this->createUrl("/seomanager/"), "hidden" => false, "access" => $this->checkAccess("manageSeo"), "onclick" => false),
    );
    $this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => ""));
    ?>
</form>


