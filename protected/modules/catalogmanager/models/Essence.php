<?php

/**
 * This is the model class for table "catalog_essence".
 *
 * The followings are the available columns in table 'catalog_essence':
 * @property integer $essence_id
 * @property integer $essence_catalog_id
 * @property integer $essence_parent_id
 * @property integer $essence_status_id
 * @property integer $essence_parent_visible
 * @property string  $essence_name
 * @property string  $essence_description
 * @property string  $essence_meta_description
 * @property string  $essence_meta_keywords
 * @property string  $essence_page_title
 * @property integer $essence_order
 * @property string  $created
 * @property integer $creator_id
 * @property string  $edition
 * @property integer $editor_id
 */
class Essence extends CMyActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }


    public function tableName() {
        return 'catalog_essence';
    }

    public function rules() {

        return array(
            array('essence_parent_id,essence_status_id, essence_name', 'required'),
            array('essence_catalog_id,essence_parent_id,essence_status_id, essence_parent_visible, essence_order, creator_id, editor_id', 'numerical', 'integerOnly' => true),
            array('essence_name, essence_description', 'length', 'max' => 256),
            array('essence_meta_description, essence_meta_keywords, essence_page_title', 'length', 'max' => 300),
        );
    }


    public function relations() {
        return array(
            'item' => array(self::HAS_MANY, 'Item', 'item_parent_id', 'order' => 'item.item_order',),
            'groups' => array(self::HAS_MANY, 'Group', 'group_essence_id', 'order' => 'groups.group_order',),
            'parameters' => array(self::HAS_MANY, 'Parameter', 'parameter_essence_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'essence_parent_id' => Translater::getDictionary()->catalogmanager_essenceParentId,
            'essence_status_id' => Translater::getDictionary()->catalogmanager_essenceStatus,
            'essence_parent_visible' => Translater::getDictionary()->catalogmanager_essenceParentVisibility,
            'essence_name' => Translater::getDictionary()->catalogmanager_essenceName,
            'essence_description' => Translater::getDictionary()->catalogmanager_essenceDescription,
            'essence_meta_description' => Translater::getDictionary()->catalogmanager_essenceMetaDescription,
            'essence_meta_keywords' => Translater::getDictionary()->catalogmanager_essenceMetaKeywords,
            'essence_page_title' => Translater::getDictionary()->catalogmanager_essencePageTitle,
            'created' => Translater::getDictionary()->created,
            'creator_id' => Translater::getDictionary()->creator,
            'edition' => Translater::getDictionary()->edition,
            'editor_id' => Translater::getDictionary()->editor,
        );
    }



    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $maxparent = Yii::app()->db->createCommand()
                        ->select('max(essence_order) as max')
                        ->from('catalog_essence')
                        ->where('essence_parent_id=:parent_id', array(':parent_id' => $this->essence_parent_id))
                        ->queryRow();

                $this->essence_order = $maxparent["max"] + 1;
                if (!$this->essence_catalog_id) {
                    $cat = Yii::app()->db->createCommand()
                            ->select('category_catalog_id')
                            ->from("catalog_category")
                            ->where('category_id=:category_parent_id', array(':category_parent_id' => $this->essence_parent_id))
                            ->queryRow();
                    $this->essence_catalog_id = $cat["category_catalog_id"];
                }

                $this->created = Time::getCurrentTime();
                $this->creator_id = Yii::app()->user->id;
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



    protected function beforeDelete() {
        if (parent::beforeDelete()) {
            return true;
        }
        else
            return false;
    }

        protected function afterDelete() {
        parent::afterDelete();
        $this->deleteRelation($this->essence_id);
    }
    
    
    public function getBreadcrumb($array) {
        if (!$this->isNewRecord) {
            $array[] = array("name" => $this->essence_name, "action" => Yii::app()->createUrl("/catalogmanager/object/index/", array("catalog" => $this->essence_catalog_id)));
        }
        return Category::model()->getBreadcrumb($this->essence_parent_id, $array);
    }


}