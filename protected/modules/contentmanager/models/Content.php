<?php

/**
 * This is the model class for table "content".
 *
 * The followings are the available columns in table 'content':
 * @property integer $content_id
 * @property integer $parent_id
 * @property integer $status_id
 * @property integer $locale_id
 * @property string  $created
 * @property integer $creator_id
 * @property string  $edition
 * @property integer $editor_id
 * @property string  $title
 * @property string  $name
 * @property string  $meta_keywords
 * @property string  $meta_text
 * @property string  $content
 * @property string  $textlink
 * @property integer $not_show_in_menu
 * @property integer $empty_link
 * @property integer $content_order
 * @property integer $main_page
 * @property integer $content_nonstructur
 * @property string  $content_hone
 * @property string  $content_redirectlink
 */
class Content extends CMyActiveRecord {

    protected $cache = array("select_tree", "not_tree", "all_content");
    protected static $cache_cleared=false;
    public $related_content;

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'content';
    }

    protected function clearCache() {
        if (!self::$cache_cleared) {
            $locale=  Locale::getLocaleList();
            foreach ($locale as $key=>$value) { 
            $array = array("menu_object_" . $key, "tree_object_locale_id" . $key, "select_tree" . $key);
            $this->addToCache($array);
            }
            self::$cache_cleared = true;
            parent::clearCache();
        }
    }

    public function rules() {
        return array(
            array('title,name', 'required'),
            array('parent_id, status_id, locale_id, not_show_in_menu,empty_link,main_page,', 'numerical', 'integerOnly' => true),
            array('title,name, meta_keywords, meta_text, textlink,content_redirectlink', 'length', 'max' => 1024),
            array('content_hone', 'length', 'max' => 512),
            array('content,related_content', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'child' => array(self::HAS_MANY, 'Content', 'parent_id', 'order' => 'child.content_order',),
            'blockrelation' => array(self::HAS_MANY, 'ContentBlockRelation', 'relation_content_id'),
            'modulrelation' => array(self::HAS_MANY, 'ContentModuleRelation', 'relation_content_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'status_id' => Translater::getDictionary()->contentmanagerStatus,
            "content_object_id" => Translater::getDictionary()->contentmanagerObjectId,
            'locale_id' => Translater::getDictionary()->contentmanagerLocale,
            'parent_id' => Translater::getDictionary()->contentmanagerParent,
            'title' => Translater::getDictionary()->contentmanagerTitle,
            'content_hone' => Translater::getDictionary()->contentmanagerH1Header,
            'content_redirectlink' => Translater::getDictionary()->contentmanagerRLink,
            'name' => Translater::getDictionary()->contentmanagerСName,
            'meta_keywords' => Translater::getDictionary()->contentmanagerMetaKeywords,
            'meta_text' => Translater::getDictionary()->contentmanagerMetaText,
            'content' => Translater::getDictionary()->contentmanagerContent,
            'textlink' => Translater::getDictionary()->contentmanagerStaticLink,
            'not_show_in_menu' => Translater::getDictionary()->contentmanagerMainMenu,
            'main_page' => Translater::getDictionary()->contentmanagerMainPage,
            'empty_link' => Translater::getDictionary()->contentmanagerEmptyLink,
        );
    }

    protected function afterSave() {
        parent::afterSave();
        if (is_array($this->related_content)) {
        RelatedContent::saveRelated($this->content_id, $this->related_content);
        }
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            $this->checkTextlink();
            $this->parent_id=$this->parent_id?$this->parent_id:0;
            if ($this->isNewRecord) {
                $maxparent = Yii::app()->db->createCommand()
                        ->select('max(content_order) as max')
                        ->from('content')
                        ->where('parent_id=:parent_id and locale_id=:locale_id', array(':parent_id' => $this->parent_id,':locale_id'=>$this->locale_id))
                        ->queryRow();
                $this->content_order = $maxparent["max"] + 1;
                $this->created = $this->edition = Time::getCurrentTime();
                $this->creator_id = $this->editor_id = Yii::app()->user->id;
            } else {
                $this->edition = Time::getCurrentTime();
                $this->editor_id = Yii::app()->user->id;
            }
             return true;
        }
        else
            return false;
    }


    protected function afterDelete() {
        parent::afterDelete();
        $this->deleteRelation($this->content_id);
    }

    private function getModelByCondition($condition, $what, $order) {
        foreach ($condition as $key => $value) {
            $where = $where . "$key=:$key and ";
            $where_array [":$key"] = $value;
        }
        $where = substr($where, 0, -4);
        $nodes = Yii::app()->db->createCommand()
                ->select($what)
                ->from($this->tableName())
                ->where($where, $where_array)
                ->order($order)
                ->queryAll();
        return $nodes;
    }

    public function getFullTree($locale_id, $parent_id='0') {
        $condition = array("parent_id" => $parent_id, "locale_id" => $locale_id, "content_nonstructur" => 0);
        $what = "content_id,locale_id,parent_id,name,status_id,edition,editor_id";
        $order = "locale_id,content_order";
        $nodes = $this->getModelByCondition($condition, $what, $order);
        $i = 0;
        $array = array();
        foreach ($nodes as $node) {
            $array[$i]["parent"] = $node;
            $array[$i]["child"] = $this->getFullTree($locale_id, $node["content_id"]);
            if (Setting::in()->countActiveLocale) {
                $array[$i]["relate"] = RelatedContent::getRelatedContent($node["content_id"], $node["locale_id"]);
            }
            $i++;
        }
        return $array;
    }

    public function getNotThree() {
        $condition = array("content_nonstructur" => 1);
        $what = "content_id,locale_id,parent_id,name,status_id,edition,editor_id,textlink";
        $order = "edition";
        $nodes = $this->getModelByCondition($condition, $what, $order);
        $array = array();
        $i = 0;
        foreach ($nodes as $node) {
            $array[$i]["parent"] = $node;
            if (Setting::in()->countActiveLocale) {
                $array[$i]["relate"] = RelatedContent::getRelatedContent($node["content_id"], $node["locale_id"]);
            }
            $i++;
        }
        return $array;
    }

    public function getContentAll($id,$locale_id=false, array $arrayresult) {
        $condition = array("parent_id" => $id);
        if ($locale_id) {
            $condition["locale_id"]=$locale_id;
        }
        $what = "content_id,name";
        $order = "content_order";
        $nodes = $this->getModelByCondition($condition, $what, $order);
        foreach ($nodes as $node) {
            $arrayresult[$node["content_id"]] = $node["name"];
            $arrayresult = $this->getContentAll($node["content_id"], $locale_id, $arrayresult);
        }
        return $arrayresult;
    }

    public function getToSelect($id, $locale_id=false, $delemitter="-", array $arrayresult=array()) {
        $condition = array("parent_id" => $id, "content_nonstructur" => 0);
        if ($locale_id) {
            $condition["locale_id"] = $locale_id;
        }
        $what = "content_id,name";
        $order = "locale_id,content_order";
        $nodes = $this->getModelByCondition($condition, $what, $order);
        foreach ($nodes as $node) {
            $arrayresult[$node["content_id"]] = $delemitter . $node["name"];
            $arrayresult = $this->getToSelect($node["content_id"], $locale_id, $delemitter . "-", $arrayresult);
        }
        return $arrayresult;
    }

    public function setRelatedContent() {
        if ($this->isNewRecord) {
            if ($this->related_content) {
                $locale_id = Yii::app()->db->createCommand()
                        ->select("locale_id")
                        ->from($this->tableName())
                        ->where("content_id=:content_id", array(":content_id" => $this->related_content))
                        ->queryScalar();
                $this->related_content = array($locale_id => $this->related_content);
            }
        } else {
            $this->related_content = array_flip(RelatedContent::getRelatedContent($this->content_id, $this->locale_id));
        }
    }

    private function checkTextlink() {
        if ($this->textlink == "") {
            $this->textlink = Translite::TranslitIt($this->name);
        } else {
            $this->textlink = Translite::TranslitIt($this->textlink);
        }
        if ($model = $this->find("textlink=? and locale_id=?", Array($this->textlink,$this->locale_id))) {
            if ($model->content_id != $this->content_id) {
                $this->textlink = $this->textlink . "_1";
            }
        }
    }

}