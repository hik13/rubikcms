<?php

/**
 * @property integer $feed_object_id
 * @property integer $feed_id
 * @property integer $status_id
 * @property integer $locale_id
 * @property string  $created
 * @property string  $feed_object_name
 * @property string  $feed_object_category
 * @property integer $creator_id
 * @property string  $edition
 * @property integer $editor_id
 * @property integer $object_order
 */
class FeedsObject extends CMyActiveRecord
{
        protected $field_order="object_order";
        protected $relation= array(array("model" =>"Feedsobjectvalue", "field" => "feed_object_id"),);
    
        public $status=array();
        
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'feeds_object';
	}


	public function rules()
	{
		return array(
			array('feed_id, status_id,feed_object_name', 'required'),
			array('feed_id, status_id, locale_id, creator_id, editor_id', 'numerical', 'integerOnly'=>true),
			array('created, edition', 'length', 'max'=>12),
                        array('feed_object_name,feed_object_id,feed_object_category', 'safe'),
			array('feed_object_id, feed_id, status_id, locale_id, created, creator_id, edition, editor_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
                'values'=>array(self::HAS_MANY, 'Feedsobjectvalue','feed_object_id'),
                'description'=>array(self::HAS_ONE, 'Feedsobjectvalue','feed_object_id'),
		);
	}


	public function attributeLabels()
	{
		return array(
			'feed_id' => Translater::getDictionary()->feedsmanagerFeedObjectFeed,
			'status_id' => Translater::getDictionary()->feedsmanagerFeedObjectStatus,
			'locale_id' => Translater::getDictionary()->feedsmanagerFeedObjectLocale,
                        'feed_object_name'=>Translater::getDictionary()->feedsmanagerFeedObjectName,
		);
	}




        protected function beforeSave() {

        if (parent::beforeSave()) {
            if (is_array($this->feed_object_category)) {
                $this->feed_object_category = serialize($this->feed_object_category);
            }
            if ($this->isNewRecord) {
                $maxparent = Yii::app()->db->createCommand()
                        ->select('max(object_order) as max')
                        ->from($this->tableName())
                        ->where('feed_id=:feed_id', array(':feed_id' => $this->feed_id))
                        ->queryRow();
                $this->object_order = $maxparent["max"] + 1;
                $this->created = $this->edition = Time::getCurrentTime();
                $this->creator_id = $this->editor_id = Yii::app()->user->id;
                return true;
            } else {
                $this->edition = Time::getCurrentTime();
                $this->editor_id = Yii::app()->user->id;
                return true;
            }
        }
        else
            return false;
    }


    
    protected function afterSave() {
        parent::afterSave();
    }
       
     protected function afterDelete() {
        parent::afterDelete();
        $this->deleteRelation($this->feed_object_id);
    }
        
        
        protected function afterFind() {
         parent::afterFind();
        if ($this->feed_object_category != "") {
            $this->feed_object_category = unserialize($this->feed_object_category);
        }
    }
        
        public function GetBlockLastObject($feedID, $count, $template, $sort) {
        $content = Content::model()->findBySql("select textlink from content where
                      content_id=(select relation_content_id from content_module_relation where relation_module_object_id=:id)", array(":id" => $feedID)
        );
        $objects = FeedsObject::model()->findAll(
                        array("limit" => $count,
                            "order" => $sort,
                            "condition" => "feed_id=:id",
                            "params" => array(":id" => $feedID),
                ));

        $array = array();
        $i = 0;
        foreach ($objects as $object) {
            $array[$i]["text"] = $object;
            $array[$i]["link"] = "/" . $content->textlink . "/?full_feed=" . $object->feed_object_id;
            ;
            $i++;
        }

        $path = "application.modules.feedsmanager.components.*";
        Yii::import($path, true);
        $v = new Viewer();
        return $v->renderPartial($template, array("objects" => $array), true, false);
    }
       
    static public function createRSS($date) {
        $models = FeedsObject::model()->with(array(
                    'description' => array(
                        'condition' => 'field_feed_id=:field_feed_id',
                        'params' => array(':field_feed_id' => $date->feed_rss['desc']),
                    ),
                ))->findAll(array(
            'condition' => 'feed_id=:feed_id',
            'params' => array(':feed_id' => $date->feed_id),
            'limit' => $date->feed_rss['pages'],
                ));
        $textlink = Content::model()->findByPk($date->relations->relation_content_id);
        $texturl = $textlink->textlink;
        $texttime = date('r', $textlink->created);
        $text = '<?xml version="1.0" encoding="UTF-8"?>';
        $text.='<rss version="2.0">';
        $text.='        <channel>';
        $text.='            <title>' . $date->feed_name . '</title>';
        $text.='            <link>http://' . $_SERVER['SERVER_NAME'] . '</link>';
        foreach ($models as $model) {
            if (Areas::is_serialized($model->description->field_feed_value)) {
                $descArray = unserialize($model->description->field_feed_value);
                $desc = $descArray['tizer'];
            } else {
                $desc = $model->description->field_feed_value;
            }

            $text.='                <item>';
            $text.='                   <title>' . $model->feed_object_name . '</title>';
            $text.='                   <link>http://' . $_SERVER['SERVER_NAME'] . '/' . $texturl . "?full_feed=" . $model->feed_object_id . '</link>';
            $text.='                   <description><![CDATA[' . $desc . ']]></description>';
            $text.='                   <pubDate>' . $texttime . '</pubDate>';
            $text.='                </item>';
        }
        $text.='        </channel>';
        $text.='    </rss> ';
        /* Добавить урл в массив feed_rss */
        $z = fopen(Yii::app()->getBaseUrl() . "site/rss/" . $date->feed_rss['name'] . ".xml", "w+");
        fwrite($z, $text);
        fclose($z);
    }

    
    public function customFinder($feed_id, $condition=false, $obj_id=false) {
        $feed = Feeds::model()->findByPk($feed_id);
        $desc = $feed->sort_by["sort"] . " " . $feed->sort_by["desc"];
        if (!$obj_id) {
            $cond = $condition ? " and fo.feed_object_category LIKE '%$condition%'" : "";
        } else {
            $cond = " and fo.feed_object_id='$obj_id'";
        }
        /* $nodes = Yii::app()->db->createCommand()
          ->select("ffv.field_value,fov.feed_object_id,fov.feed_object_id,fov.field_feed_value")
          ->from("field_feeds_value as ffv")
          ->leftJoin("feeds_object_value as fov", "ffv.field_feed_id=fov.field_feed_id")
          ->leftJoin("feeds_object as fo", "fo.feed_id=fov.feed_object_id ")
          ->order("fo.".$desc)
          ->where("ffv.field_feed_id in (select field_feed_id from field_feeds where feed_id='$feed_id')
          and property_id in (select property_id from field_type_property where property_name_id='template_name') $cond")
          ->queryAll(); */
        $nodes = Yii::app()->db->createCommand()
                ->select("ffv.field_value,fov.feed_object_id,fov.field_feed_value")
                ->from("feeds_object as fo")
                ->leftJoin("feeds_object_value as fov", "fo.feed_object_id=fov.feed_object_id")
                ->leftJoin("field_feeds_value as ffv", "fov.field_feed_id=ffv.field_feed_id ")
                ->order("fo." . $desc)
                ->where("ffv.field_feed_id in (select field_feed_id from field_feeds where feed_id='$feed_id') 
                        and property_id in (select property_id from field_type_property where property_name_id='template_name') $cond")
                ->queryAll();
        foreach ($nodes as $node) {
            $array[$node["feed_object_id"]][$node["field_value"]] = $this->is_serialized($node["field_feed_value"]) ? unserialize($node["field_feed_value"]) : $node["field_feed_value"];
        }
        return ($array);
    }
    
    
}