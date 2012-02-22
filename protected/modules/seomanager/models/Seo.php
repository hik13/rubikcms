<?php

/**
 * This is the model class for table "seo".
 *
 * @property integer $seo_id
 * @property string $seo_key
 * @property string $seo_text
 */
class Seo extends CMyActiveRecord {

    public $counters = array();

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'seo';
    }

    public function rules() {
        return array(
            array('seo_text', 'safe'),
        );
    }

    public function relations() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'seo_id' => 'Seo',
            'seo_key' => 'Seo Key',
            'seo_text' => 'Seo Text',
        );
    }

    protected function initCounters() {
        if ($this->is_serialized($this->seo_text)) {
            $property = unserialize($this->seo_text);
            if (isset($property["counters"])) {
                foreach ($property["counters"] as $counter) {
                    $c = new Seocounter();
                    $c->attributes = $counter;
                    $this->counters[] = $c;
                }
            }
        }
    }

    protected function afterFind() {
        parent::afterFind();
        if ($this->seo_key == "seoCounters") {
            $this->initCounters();
        }
    }

    public static function seoAnalyz(Content $model) {
        $sm = self::model();
        if ($seomodel = $sm->getCache("property_seo", $sm, "getKeyValueArray", array("seo_key", "seo_text"))) {
            $model->meta_keywords = $model->meta_keywords ? $model->meta_keywords : $seomodel["seoMainMetaKeyword"];
            $model->meta_text = $model->meta_text ? $model->meta_text : $seomodel["seoMainMetaDescription"];
            if ($sm->is_serialized($seomodel["seoCounters"])) {
                $counters = unserialize($seomodel["seoCounters"]);
                if (is_array($counters["counters"])) {
                    foreach ($counters["counters"] as $counter) {
                        $c = new Seocounter();
                        $c->attributes = $counter;
                        $c->registrCodeCounter($model);
                    }
                }
            }
        }
        return $model;
    }

}