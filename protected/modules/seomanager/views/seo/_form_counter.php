<ul class="catalog-list">
    <li class="catalog-group-li">
        <div class="menu-item active-item clearfix">			
            <div class="section-title" 
            <?php if ($ajax) { ?>
                     style="display:none"
                 <?php } ?>
                 >				
                <div class="inner-border clearfix">					
                    <ul class="table-action-buttons clearfix">											
                        <li class="table-action-delete">
                            <a title="Удалить" onclick="deleteCounter(this)"></a>
                        </li>					
                    </ul>					
                    <a   onclick="showCounterNameForm(this)" class="form-button"><?php echo $model->seoCounterName ?></a>				
                </div>			
            </div>  
            <div class="catalog-edit-form" 
            <?php if (!$ajax) { ?>
                     style="display:none"
                 <?php } ?>
                 >
                <div class="catalog-edit-pointer">
                </div>
                <?php
                $inputs = array(
                    array("type" => "textfield",
                        "label" => CHtml::activeLabel($model, "seoCounterName"),
                        "input" => CHtml::TextField("Seo[$i][seo_text][counters][$j][seoCounterName]", $model->seoCounterName, array("class" => "counterName")),
                    ),
                    array("type" => "textarea",
                        "label" => CHtml::activeLabel($model, "seoCounterCode"),
                        "input" => CHtml::TextArea("Seo[$i][seo_text][counters][$j][seoCounterCode]", $model->seoCounterCode, array("rows" => 7)),
                    ),
                    array("type" => "select",
                        "label" => CHtml::activeLabel($model, "seoCounterPlaceInput"),
                        "input" => CHtml::dropDownList("Seo[$i][seo_text][counters][$j][seoCounterPlaceInput]", $model->seoCounterPlaceInput, $model->placeinput),
                        ));

                if (Setting::in()->countActiveLocale) {
                    $inputs[] = array(
                        "type" => "select",
                        "label" => CHtml::activeLabel($model, 'seoCounterLanguageVersion'),
                        "input" => CHtml::dropDownList("Seo[$i][seo_text][counters][$j][seoCounterLanguageVersion]", $model->seoCounterLanguageVersion, $locale, array("empty" => Translater::getDictionary()->seoTitleForAllVersion)),
                    );
                } else {
                    $inputs[] = array(
                        "type" => "hidden",
                        "input" => CHtml::hiddenField("Seo[$i][seo_text][counters][$j][seoCounterLanguageVersion]", Setting::in()->defaultLocaleId)
                    );
                }

                $this->renderPartial("//block/inputs/rendertypedInputs", array("inputs" => $inputs));
                $blockButton = array(
                    array("name" => Translater::getDictionary()->button_cansel, "class" => "", "hidden" => false, "action" => false, 'access' => $this->checkAccess("manageSeo"), "onclick" => "canselSaveCounter(this)"),
                    array("name" => Translater::getDictionary()->button_ok, "class" => "", "hidden" => false, "action" => false, "access" => $this->checkAccess("manageSeo"), "onclick" => "SaveParameter(this)"),
                );
                $this->renderPartial("//block/ul_button", array("buttons" => $blockButton, "additional_class_ul" => "right-position"));
                ?>
            </div>
        </div>
    </li>
</ul>


