<?php

/**
 * @property integer $locale_id
 * @property string  $locale_description
 * @property string  $locale_code
 * @property integer $locale_default
 * @property integer $locale_status
 * @property integer $locale_order 
 * @property integer $locale_prefix_version
 * @property string  $locale_domen_version
 */
class Locale extends CMyActiveRecord {

    protected $cache = array("all_models_locale");
    protected static $property = array(
        "countActiveLocale" => "countActiveLocale",
        "defaultLocaleId" => "defaultLocaleId",
        "defaultLocaleCode" => "defaultLocaleCode");

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'locale';
    }

    public function rules() {

        return array(
            array('locale_description, locale_code', 'required'),
            array('locale_default,locale_order,locale_status,locale_prefix_version', 'numerical', 'integerOnly' => true),
            array('locale_description', 'length', 'max' => 128),
            array('locale_domen_version', 'length', 'max' => 512),
            array('locale_code', 'length', 'max' => 16),
        );
    }

    public function attributeLabels() {
        return array(
            'locale_description' => Translater::getDictionary()->localemanagerLocaleName,
            'locale_code' => Translater::getDictionary()->localemanagerLocaleCode,
            'locale_default' => Translater::getDictionary()->localemanagerLocaleDefault,
            'locale_status' => Translater::getDictionary()->localemanagerLocaleStatus,
            'locale_prefix_version'=>Translater::getDictionary()->localemanagerLocalePrefixVersion,
            'locale_domen_version'=>Translater::getDictionary()->localemanagerLocaleDomenVersion,
        );
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $maxparent = Yii::app()->db->createCommand()
                        ->select('max(locale_order) as max')
                        ->from('locale')
                        ->queryRow();
                $this->locale_order = $maxparent["max"] + 1;
            }
            return true;
        }
        else
            return false;
    }

    protected function afterDelete() {
        parent::afterDelete();
        $this->setSettings();
    }

    protected function afterSave() {
        parent::afterSave();
        $this->setSettings();
    }

    public function changeDefaultLocale() {
        if ($model = self::model()->find('locale_default=:locale_default', array(':locale_default' => 1))) {
            $model->locale_default = 0;
            $model->save();
        }
        $this->locale_default = 1;
        $this->save();
    }

    private function setSettings() {
        $models = $this->findAll("locale_status='1'");
        $rezult = 0;
        if (is_array($models))
            $rezult = count($models) > 1 ? 1 : 0;
        $this->setProperty(self::$property["countActiveLocale"], $rezult);
        foreach ($models as $model) {
            if ($model->locale_default == "1") {
                $this->setProperty(self::$property["defaultLocaleId"], $model->locale_id);
                $this->setProperty(self::$property["defaultLocaleCode"], $model->locale_code);
                break;
            }
        }
    }

    private function analyzLink(Content $model) {
        if ($this->locale_prefix_version) {
            if ($this->locale_default) {
                return "/";
            } else
                return "/" . $this->locale_code;
        } else if (!empty($this->locale_domen_version)) {
            return "http://" . $this->locale_domen_version;
        }
    }

    public static function getLocaleList(array $need=array("key" => "locale_id", "value" => "locale_code"), $active=true) {
        $locales = self::getCache("all_models_locale", self::model(), "findAll", array(array('order' => "locale_default DESC,locale_order")));
        $rezult = array();
        foreach ($locales as $locale) {
            if ($active && $locale->locale_status == '1') {
                $rezult[$locale->$need["key"]] = $locale->$need["value"];
            } else if (!$active) {
                $rezult[$locale->$need["key"]] = $locale->$need["value"];
            }
        }
        return $rezult;
    }



   public static function getLocaleListNavifation(Content $model) {
        $locales = self::getCache("all_models_locale", self::model(), "findAll", array(array('order' => "locale_default DESC,locale_order")));
        $rezult = array();
        $i=0;
        foreach ($locales as $locale) {
            if ($locale->locale_status == '1') {
               $rezult[$i]["active"]=$locale->locale_id==$model->locale_id?true:false;
               $rezult[$i]["code"]=$locale->locale_code;
               $rezult[$i]["link"]=$locale->analyzLink($model);
            }
            $i++;
        }
        return $rezult;
    }
    
    
}