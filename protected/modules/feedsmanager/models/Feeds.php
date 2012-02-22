<?php

/**
 * @property integer $feed_id
 * @property string  $feed_name
 * @property string  $category
 * @property string  $template
 * @property integer $on_page
 * @property string  $sort_by
 * @property string  $feed_rss
 * @property integer $feed_status
 */
class Feeds extends CMyActiveRecord {

    protected $tempCondition;
    public $sort_array = array("created" => "feedsmanagerFeedObjectCreated",
        "feed_object_name" => "feedsmanagerFeedObjectName",
        "edition" => "feedsmanagerFeedObjectEdited",
        "object_order" => "feedsmanagerFeedObjectOrder");
    public $sort_line = array(
        "" => "feedsmanagerFeedObjectSortUp",
        "desc" => "feedsmanagerFeedObjectSortDesk",);
    public $category=array();
    
    
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'feeds';
    }

    public function rules() {
        return array(
            array('feed_name', 'required'),
            array('on_page,feed_status', 'numerical', 'integerOnly' => true),
            array('feed_name', 'length', 'max' => 256),
            array('feed_name, category, template,on_page,sort_by', 'safe'),
        );
    }

    public function relations() {
        return array(
            'fields' => array(self::HAS_MANY, 'Fieldfeeds', 'feed_id'),
            'object' => array(self::HAS_MANY, 'Feedsobject', 'feed_id'),
            'relations' => array(self::HAS_MANY, 'Contentmodulerelation', 'relation_module_object_id')
        );
    }

    public function attributeLabels() {
        return array(
            'feed_name' => Translater::getDictionary()->feedsmanagerFeedName,
            'category' => Translater::getDictionary()->feedsmanagerFeedCategory,
            'template' => Translater::getDictionary()->feedsmanagerFeedTemplate,
            'on_page' => Translater::getDictionary()->feedsmanagerFeedOnPage,
            'sort_by' => Translater::getDictionary()->feedsmanagerFeedSortBy,
            'feed_rss' => Translater::getDictionary()->feedsmanagerFeedSortBy,
            'feed_status' => Translater::getDictionary()->feedsmanagerFeedStatus,
        );
    }

    protected function clearCache() {
        $array = array("feed_fields_" . $this->feed_id);
        $this->addToCache($array);
        parent::clearCache();
    }

    
    protected function beforeValidate() {
        if (parent::beforeValidate()) {
            $array = array();
            foreach ($this->category as $key => $value) {
                if (trim($value) != "") {
                    $array[$key] = $value;
                }
            }
            $this->category = serialize($array);
            return true;
        }
        else
            return false;
    }
    
    protected function afterFind() {
        parent::afterFind();
        if ($this->feed_rss) {
            $this->feed_rss = unserialize($this->feed_rss);
        }
        $this->category =$this->is_serialized($this->category)? unserialize($this->category):array();
        $this->sort_by = unserialize($this->sort_by);
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            if (is_array($this->feed_rss)) {
                $this->feed_rss = serialize($this->feed_rss);
            } else {
                $this->feed_rss = NULL;
            }
            $this->sort_by = serialize($this->sort_by);
            return true;
        }
        else
            return false;
    }

    protected function afterSave() {
        parent::afterSave();
        if ($this->tempCondition != "") {
            foreach ($this->tempCondition as $relations) {
                if ($relations["relation_id"]) {
                    $relation = Contentmodulerelation::model()->find("relation_id=?", Array($relations["relation_id"]));
                } else {
                    $relation = new Contentmodulerelation();
                    $relation->relation_module_id = "M-FM";
                    $relation->relation_module_object_id = $this->feed_id;
                }

                $relation->relation_content_id = $relations["relation_content_id"];
                $relation->relation_module_condition = serialize($relations["relation_module_condition"]);
                $relation->save();
            }
        }
    }

    protected function deleteRelation($id) {
        $relations = $this->relations();
        foreach ($relations as $relation) {
            if ($relation[0] == "CHasManyRelation") {
                if ($relation[1] != "Contentmodulerelation") {
                    $models = $relation[1]::model()->findAll($relation[2] . "=?", Array($id));
                } else {
                    $models = $relation[1]::model()->findAll($relation[2] . "=? and relation_module_id='M-FM'", Array($id));
                }
                foreach ($models as $model) {
                    $model->delete();
                }
            }
        }
    }

    protected function afterDelete() {
        parent::afterDelete();
        $this->deleteRelation($this->feed_id);
    }

}