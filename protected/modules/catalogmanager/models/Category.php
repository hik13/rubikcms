<?php

/**
 * @property integer $category_id
 * @property integer $category_catalog_id
 * @property integer $category_parent_id
 * @property integer $category_status_id
 * @property integer $category_parent_visible
 * @property string $category_name
 * @property string $category_description
 * @property string $category_meta_description
 * @property string $category_meta_keywords
 * @property string $category_page_title
 * @property string $created
 * @property integer $creator_id
 * @property string $edition
 * @property integer $editor_id
 */
class Category extends CMyActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'catalog_category';
    }

    public function rules() {
        return array(
            array('category_parent_id,category_catalog_id, category_status_id, category_name', 'required'),
            array('category_parent_id,category_catalog_id, category_status_id, category_parent_visible', 'numerical', 'integerOnly' => true),
            array('category_name, category_description', 'length', 'max' => 256),
            array('category_meta_description, category_meta_keywords, category_page_title', 'length', 'max' => 300),
            array('category_id,category_catalog_id, category_parent_id, category_status_id, category_parent_visible, category_name, category_description, category_meta_description, category_meta_keywords, category_page_title, created, creator_id, edition, editor_id', 'safe',),
        );
    }

    public function relations() {
        return array(
            'cat' => array(self::HAS_MANY, 'Category', 'category_parent_id'),
            'essence' => array(self::HAS_MANY, 'Essence', 'essence_parent_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'category_parent_id' => Translater::getDictionary()->catalogmanager_categoryParentId,
            'category_status_id' => Translater::getDictionary()->catalogmanager_categoryStatus,
            'category_parent_visible' => Translater::getDictionary()->catalogmanager_categoryParentVisibility,
            'category_name' => Translater::getDictionary()->catalogmanager_categoryName,
            'category_description' => Translater::getDictionary()->catalogmanager_categoryDescription,
            'category_meta_description' => Translater::getDictionary()->catalogmanager_categoryMetaDescription,
            'category_meta_keywords' => Translater::getDictionary()->catalogmanager_categoryMetaKeywords,
            'category_page_title' => Translater::getDictionary()->catalogmanager_categoryPageTitle,
            'created' => Translater::getDictionary()->created,
            'creator_id' => Translater::getDictionary()->creator,
            'edition' => Translater::getDictionary()->edition,
            'editor_id' => Translater::getDictionary()->editor,
        );
    }



    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                if (!$this->category_catalog_id) {
                    $cat = Yii::app()->db->createCommand()
                            ->select('category_catalog_id')
                            ->from($this->tableName())
                            ->where('category_id=:category_parent_id', array(':category_parent_id' => $this->category_parent_id))
                            ->queryRow();
                    $this->category_catalog_id = $cat["category_catalog_id"];
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

    protected function afterDelete() {
        parent::afterDelete();
        $this->deleteRelation($this->category_id);
    }
    
    
    public function getBreadcrumb($id, $array) {
        if ($p = Yii::app()->db->createCommand()
                ->select('category_id as id, category_parent_id as parent_id,category_name as name')
                ->from($this->tableName())
                ->where('category_id=:category_id', array(':category_id' => $id))
                ->queryRow()) {
            $array[] = array("name" => $p["name"], "action" => Yii::app()->createUrl("/catalogmanager/object/index/", array("catalog" => "category", "id" => $p["id"])));
            if ($p["category_parent_id"] != 0) {
                $array = $this->getBreadcrumb($p["parent_id"], $array);
            }
        }
        return $array;
    }

}