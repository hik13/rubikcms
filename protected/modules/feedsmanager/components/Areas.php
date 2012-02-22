<?php

class Areas extends CHtml {

    static $counter = 0;
    static $full = false;
    static $locales=array();

    static public function printArea(Fieldfeeds $feedsField, $object_values) {
        self::$locales=Locale::getLocaleList(Array("key" => "locale_id", "value" => "locale_description"));
        switch ($feedsField->fieldstype->field_type_id) {
            case 1 : {
                    $return = self::printTextField($feedsField, $object_values);
                    break;
                }
            case 2 : {
                    $return = self::printTextArea($feedsField, $object_values);
                    break;
                }
            case 3 : {
                    $return = self::printDateArea($feedsField, $object_values);
                    break;
                }
            case 4 : {
                    $return = self::printImageArea($feedsField, $object_values);
                    break;
                }
            case 5 : {
                    $return = self::printFileArea($feedsField, $object_values);
                    break;
                }
            case 6 : {
                    $return = self::printDropListArea($feedsField, $object_values);
                    break;
                }  
            case 7 : {
                    $return = self::printGaleryArea($feedsField, $object_values);
                    break;
                }       
        }
        self::$counter = self::$counter + 1;
        return $return;
    }

    static private function printTextField(Fieldfeeds $field, $object_values) {

         $inputs = array(
            array("type" => "hidden",
                "input" => self::hiddenField("FeedObjectValue[" . self::$counter . "][feed_object_value_id]", $object_values->feed_object_value_id, array())
            ),
            array("type" => "hidden",
                "input" => self::hiddenField("FeedObjectValue[" . self::$counter . "][field_feed_id]", $field->field_feed_id, array())
            ),
            );
         $name=$field->getValue("name");
         foreach (self::$locales as $key => $value) {
            $inputs[] = array("type" => "textfield",
                "label" => self::Label($name . " - " . $value, 'textfield'),
                "input" => CHtml::textField("FeedObjectValue[" . self::$counter . "][field_feed_value][$key]", $object_values->field_feed_value[$key], array()),
                "error" => "",
            );
         }
          return $inputs ;
    }

    static private function printTextArea(Fieldfeeds $field, $object_values) {
        if ($field->getValue("editor") == "1") {
            Yii::app()->clientScript->registerScriptFile(Yii::app()->getTheme()->getBaseUrl() . '/js/public/tiny_mce/jquery.tinymce.js', CClientScript::POS_HEAD);
            Yii::app()->clientScript->registerScriptFile(Yii::app()->getTheme()->getBaseUrl() . '/js/private/tinymce_init.js', CClientScript::POS_HEAD);
            $class = "tinymce";
        } else {
            $class = "";
        }
        $inputs = array(
            array("type" => "hidden",
                "input" => self::hiddenField("FeedObjectValue[" . self::$counter . "][feed_object_value_id]", $object_values->feed_object_value_id, array())
            ),
            array("type" => "hidden",
                "input" => self::hiddenField("FeedObjectValue[" . self::$counter . "][field_feed_id]", $field->field_feed_id, array())
            ),
        );
        $name = $field->getValue("name");
        if ($field->getValue("tiezer") == "1") {
            $values = $object_values->field_feed_value[$key];
            foreach (self::$locales as $key => $value) {
                $inputs[] = array("type" => "textarea",
                    "label" => self::Label("Tiezer - " . $value, "textarea"),
                    "input" => self::textArea("FeedObjectValue[" . self::$counter . "][field_feed_value][$key][tizer]", $values["tizer"], array('style' => "width:100%;height:300px", 'class' => $class)),
                    "error" => "",
                );
                $inputs[] = array("type" => "textarea",
                    "label" => self::Label($name . " - " . $value, "textarea"),
                    "input" => self::textArea("FeedObjectValue[" . self::$counter . "][field_feed_value][$key][text]", $values["text"], array('style' => "width:100%;height:300px", 'class' => $class)),
                    "error" => "",
                );
            }
        } else {
            foreach (self::$locales as $key => $value) {
                $inputs[] = array("type" => "textarea",
                    "label" => self::Label($name . " - " . $value, 'textarea'),
                    "input" => CHtml::textArea("FeedObjectValue[" . self::$counter . "][field_feed_value][$key]", $object_values->field_feed_value[$key], array('style' => "width:100%;height:300px", 'class' => $class)),
                    "error" => "",
                );
            }
        }

        
        
        return $inputs;
    }

    static private function printDateArea(Fieldfeeds $field, $object_values) {

        return $inputs = array(
            array("type" => "hidden",
                "input" => self::hiddenField("FeedObjectValue[" . self::$counter . "][feed_object_value_id]", $object_values->feed_object_value_id, array())
            ),
            array("type" => "hidden",
                "input" => self::hiddenField("FeedObjectValue[" . self::$counter . "][field_feed_id]", $field->field_feed_id, array())
            ),
            array("type" => "textfield",
                "label" => self::Label($field->getValue("name"), "textfield"),
                "input" => self::TextField("FeedObjectValue[" . self::$counter . "][field_feed_value]", $object_values->field_feed_value ? $object_values->field_feed_value : date($field->getValue("time_format")), array("class" => "inputDate", "id" => "inputDate")),
                "error" => "",
            ),
        );
    }

    static private function printImageArea(Fieldfeeds $field, $object_values) {
        Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('feedsmanager.resourse.js') . '/filefead.js'), CClientScript::POS_HEAD);
        $image = !empty($object_values->field_feed_value) ? "<img src='".  Uploader::getUploadedPatch($object_values->field_feed_value,true) ."'>" : "";
        return $inputs = array(
            array("type" => "hidden",
                "input" => self::hiddenField("FeedObjectValue[" . self::$counter . "][feed_object_value_id]", $object_values->feed_object_value_id, array())
            ),
            array("type" => "hidden",
                "input" => self::hiddenField("FeedObjectValue[" . self::$counter . "][field_feed_id]", $field->field_feed_id, array())
            ),
            array("type" => "hidden",
                "input" => self::hiddenField("FeedObjectValue[" . self::$counter . "][field_feed_value]", $object_values->field_feed_value, array("class" => "uploadedImage"))
            ),
            array("type" => "hidden",
                "input" => self::hiddenField("FeedObjectValue[" . self::$counter . "][setting][type]","image", array())
            ),
            array("type" => "hidden",
                "input" => self::hiddenField("FeedObjectValue[" . self::$counter . "][setting][imagewidth]", $field->getValue("imagewidth"), array())
            ),
            array("type" => "hidden",
                "input" => self::hiddenField("FeedObjectValue[" . self::$counter . "][setting][imageheight]", $field->getValue("imageheight"), array())
            ),
            array("type" => "file",
                "label" => self::Label($field->getValue("name"), "filefield"),
                "input" => self::fileField("FeedObjectValue[" . self::$counter . "][imagefile]", "", array("class" => "imageToUpload", "id" => "")).$image,
                "error" => "",
            ),
            array("type" => "nothing",
                "input" => "<div class='errormessage'></div>",
            ),
        );
    }

    static private function printFileArea(Fieldfeeds $field, $object_values) {
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/public/jquery.form.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('feedsmanager.resourse.js') . '/filefead.js'), CClientScript::POS_HEAD);
        $a = !empty($object_values->field_feed_value) ? "<a href='{$object_values->field_feed_value}' >{$object_values->field_feed_value}</a>" : "<a  style='display:none'>f</a>";

        return $inputs = array(
            array("type" => "hidden",
                "input" => self::hiddenField("FeedObjectValue[" . self::$counter . "][feed_object_value_id]", $object_values->feed_object_value_id, array())
            ),
            array("type" => "hidden",
                "input" => self::hiddenField("FeedObjectValue[" . self::$counter . "][field_feed_id]", $field->field_feed_id, array())
            ),
            array("type" => "hidden",
                "input" => self::hiddenField("FeedObjectValue[" . self::$counter . "][field_feed_value]", $object_values->field_feed_value, array("class" => "uploadedFile"))
            ),
            array("type" => "hidden",
                "input" => self::hiddenField("uploadfile", true, array())
            ),
            array("type" => "hidden",
                "input" => self::hiddenField("file_size", $field->getValue("file_size"), array())
            ),
            array("type" => "hidden",
                "input" => self::hiddenField("imageheight", $field->getValue("imageheight"), array())
            ),
            array("type" => "file",
                "label" => self::Label($field->getValue("name"), "filefield"),
                "input" => self::fileField("fileToUpload", "", array("class" => "fileToUpload", "id" => "")),
                "error" => "",
            ),
            array("type" => "nothing",
                "input" => "<div class='errormessage'></div>" . $a,
            ),
        );
    }
    
    
      static private function printDropListArea(Fieldfeeds $field, $object_values) {
        return $inputs = array(
            array("type" => "hidden",
                "input" => self::hiddenField("FeedObjectValue[" . self::$counter . "][feed_object_value_id]", $object_values->feed_object_value_id, array())
            ),
            array("type" => "hidden",
                "input" => self::hiddenField("FeedObjectValue[" . self::$counter . "][field_feed_id]", $field->field_feed_id, array())
            ),
            array("type" => "select",
                  "label" => self::Label($field->getValue("name"), "field_feed_valued"),
                  "input" => self::dropDownList("FeedObjectValue[" . self::$counter . "][field_feed_value]", $object_values->field_feed_value, $field->getValue("list_data_add"))
            ),
        );
    }
    
    
      static private function printGaleryArea(Fieldfeeds $field, $object_values) {
        $values = empty($object_values->field_feed_value) ? array() : $object_values->field_feed_value;
        $sizes = $field->getValue("image_galery_add");
        return $inputs = array(
            array("type" => "hidden",
                "input" => self::hiddenField("FeedObjectValue[" . self::$counter . "][feed_object_value_id]", $object_values->feed_object_value_id, array())
            ),
            array("type" => "hidden",
                "input" => self::hiddenField("FeedObjectValue[" . self::$counter . "][field_feed_id]", $field->field_feed_id, array())
            ),
            array("type" => "hidden",
                "input" => self::hiddenField("FeedObjectValue[" . self::$counter . "][setting][type]", "imagegalery", array())
            ),
            array("type" => "hidden",
                "input" => self::hiddenField("FeedObjectValue[" . self::$counter . "][setting][sizes]", serialize($sizes), array())
            ),
            array("type" => "select",
                "label" => self::Label($field->getValue("name"), "filefield"),
                "input" => Yii::app()->controller->renderPartial("/feedsobject/template/galery_template", array("get_full" => true, 'name' => "FieldGaleryObjectValue[" . self::$counter . "][galeryfile]", "values" => $values, "sizes" => $sizes), true),
            ),
        );
    }
    
    
    
    static public function changeTemplate(array $array, FeedsObjectValue $value, $template,$locale_id) {

        switch ($array[$value->field_feed_id]["type_id"]) {
            case 1 : {
                    return self::changeTextTemplate($array[$value->field_feed_id]["label"], $value->field_feed_value[$locale_id], $template);
                    break;
                }
            case 2 : {
                    return self::changeTextAreaTemplate($array[$value->field_feed_id]["label"], $value->field_feed_value[$locale_id], $value, $template);
                    break;
                }
            case 3 : {
                    return self::changeDateTemplate($array[$value->field_feed_id]["label"], $value->field_feed_value, $template);
                    break;
                }
            case 4 : {
                    return self::changeImageTemplate($array[$value->field_feed_id]["label"], $value->field_feed_value, $template);
                    break;
                }
            case 5 : {
                    return self::changeFileTemplate($array[$value->field_feed_id]["label"], $value->field_feed_value, $template);
                    break;
                }
        }
    }

    
    
    
    static public function is_serialized($data) {
        return (@unserialize($data) !== false);
    }

    static public function changeTextTemplate($label, $value, $template) {
        return str_replace("{" . $label . "}", $value, $template);
    }

    static public function changeTextAreaTemplate($label, $value, FeedsObjectValue $object, $template) {
        if (is_array($value)) {
            if (empty($value["tizer"]) or self::$full) {
                $value = $value["text"];
                if (self::$full) {
                    $value = $value . "<a href='" . preg_replace("/\/(full_feed\/" . $object->feed_object_id . ")/i", "", $_SERVER["REQUEST_URI"]) . "' class='backTo'>" . FrontTranslater::getDictionary()->backTo . "</a>";
                }
            } else {
                $char = strpos($_SERVER["REQUEST_URI"], "?") ? "&" : "?";
                $value = $value["tizer"] . "<a href='" . $_SERVER["REQUEST_URI"] . "/full_feed/" . $object->feed_object_id . "' class='readMore'>" . FrontTranslater::getDictionary()->readMore . "</a>";
            }
        }
        return str_replace("{" . $label . "}", $value, $template);
    }

    static public function changeDateTemplate($label, $value, $template) {
        return str_replace("{" . $label . "}", $value, $template);
    }

    static public function changeImageTemplate($label, $value, $template) {
        return str_replace("{" . $label . "}", "<img src='".Uploader::getUploadedPatch($value,true)."'/>", $template);
    }

    static public function changeFileTemplate($label, $value, $template) {
        return str_replace("{" . $label . "}", "<a href='$value'>Download</a>", $template);
    }

}

?>
