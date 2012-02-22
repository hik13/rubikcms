<?php

class Banner extends CMyActiveRecord {

    protected $field_order = "banner_order";

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'banner';
    }

    public function rules() {
        return array(
            array('banner_name', 'required'),
            array('banner_position_id, banner_status , banner_type, banner_priority', 'numerical', 'integerOnly' => true),
            array('banner_name', 'length', 'max' => 128),
            array('banner_desc', 'length', 'max' => 512),
            array('banner_name', 'length', 'max' => 128),
            array('banner_pattern, banner_date_to', 'safe'),
        );
    }

    public function relations() {
        return array(
            "blockrelation" => array(self::HAS_MANY, 'Contentblockrelation', 'relation_block_id',),
        );
    }

    public function getRelatedPosition() {
        $models = $this->findAll(array('order' => "banner_position_id,banner_order"));
        $tables = array();
        if (($orients = Blockposition::model()->getKeyValueArray("position_id", "position_desk", array("order" => "position_code"), array(0 => "Без позиции"))) && (!empty($models))) {
            $i = 0;
            foreach ($orients as $key => $orient) {
                $tables[$i]["key"] = $key;
                $tables[$i]["header"] = $orient;
                $tables[$i]["rows"] = $this->returnModelbyKey($models, $key);
                $i++;
            }
        }
        return $tables;
    }

    private function returnModelbyKey(array $models, $key) {
        $array = array();
        foreach ($models as $model) {
            if ($model->banner_position_id == $key)
                $array[] = $model;
        }
        return $array;
    }

    public function attributeLabels() {
        return array(
            'banner_name' => Translater::getDictionary()->bannerModule_Name,
            'banner_desc' => Translater::getDictionary()->bannerModule_Description,
            'banner_position_id' => Translater::getDictionary()->bannerModule_Position,
            'banner_type' => Translater::getDictionary()->bannerModule_Type,
            'banner_priority' => Translater::getDictionary()->bannerModule_Priority,
            'banner_pattern' => Translater::getDictionary()->bannerModule_Pattern,
            'banner_date_to' => Translater::getDictionary()->bannerModule_DateTo,
            "banner_status" => Translater::getDictionary()->bannerModule_Status
        );
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            if (!empty($this->banner_date_to)) {
                $date_elements = explode("-", $this->banner_date_to);
                $this->banner_date_to = mktime(0, 0, 0, $date_elements[1], $date_elements[0], $date_elements[2]);
            }
            if ($this->isNewRecord) {
                $maxparent = Yii::app()->db->createCommand()
                        ->select('max(banner_order) as max')
                        ->from($this->tableName())
                        ->where('banner_position_id=:banner_position_id', array(':banner_position_id' => $this->banner_position_id))
                        ->queryRow();
                $this->banner_order = $maxparent["max"] + 1;
                $this->banner_created = $this->banner_edition = Time::getCurrentTime();
                $this->banner_creator_id = $this->banner_editor_id = Yii::app()->user->id;
            } else {
                $this->banner_edition = Time::getCurrentTime();
                $this->banner_editor_id = Yii::app()->user->id; 
            }
             return true;
        }
        else
            return false;
    }

    protected function beforeDelete() {
        if (parent::beforeDelete()) {
            Uploader::delfile('/' . $this->banner_url);
            return true;
        }
        else
            return false;
    }

    public function manageRelation(array $post) {
        $relation = Contentblockrelation::model()->getAllRelation($this->banner_id, "1");
        $common = array_intersect($post, $relation);
        $add_relation = array_diff($post, $common);
        $del_relation = array_diff($relation, $common);
        foreach ($add_relation as $rel) {
            $relationModel = new ContentBlockRelation();
            $relationModel->relation_content_id = $rel;
            $relationModel->relation_block_id = $this->banner_id;
            $relationModel->relation_block_type = '1';
            $relationModel->save();
        }
        foreach ($del_relation as $key => $rel) {
            $relationModel = Contentblockrelation::model()->findByPk($key);
            $relationModel->delete();
        }
    }

    public static function getHtmlBanner($banner_type, $banner_url, $banner_pattern) {
        if ($banner_type) {
            $htmlBanner = "<embed src='/" . $banner_url . "' quality='high'></embed>";
        } else {
            $htmlBanner = "<img src='/" . $banner_url . "'/>";
        }
        return str_replace('{banner}', $htmlBanner, $banner_pattern);
    }

}