<?php

/**
 * This is the model class for table "catalog_item".
 *
 * The followings are the available columns in table 'catalog_item':
 * @property integer $item_id
 * @property integer $item_parent_id
 * @property integer $item_manufacturer_id
 * @property integer $item_status_id
 * @property string $item_name
 * @property string $item_short_description
 * @property string $item_full_description
 * @property string $item_description
 * @property string $item_meta_description
 * @property string $item_meta_keywords
 * @property string $item_page_title
 * @property string $item_rating
 * @property integer $item_order
 * @property string $created
 * @property integer $creator_id
 * @property string $edition
 * @property integer $editor_id
 */
class Item extends CMyActiveRecord {

    public $parent;
    public static $relatedModel=array("ValueBoolean","ValueLiteral","ValueNumeric","ValueSelectable");
    /**
     * Returns the static model of the specified AR class.
     * @return Item the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'catalog_item';
    }

     public function getTableSchema() {
        $table = parent::getTableSchema();
        $table->columns['item_manufacturer_id']->isForeignKey = true;
        $table->foreignKeys['item_manufacturer_id'] = array('Manufacturer', 'manufacturer_id');
        return $table;
    }
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('item_parent_id, item_status_id, item_name', 'required'),
            array('item_parent_id, item_status_id, item_order, creator_id, editor_id,item_manufacturer_id', 'numerical', 'integerOnly' => true),
            array('item_name, item_short_description, item_description', 'length', 'max' => 256),
            array('item_full_description', 'length', 'max' => 1500),
            array('item_meta_description, item_meta_keywords, item_page_title, item_rating', 'length', 'max' => 300),
            array('created, edition', 'length', 'max' => 12),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('item_id, item_parent_id,item_manufacturer_id,item_status_id, item_name, item_short_description, item_full_description, item_description, item_meta_description, item_meta_keywords, item_page_title, item_rating, item_order, created, creator_id, edition, editor_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
         "manufacturer" => array(self::BELONGS_TO, 'Manufacturer', 'item_manufacturer_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'item_id' => 'Item',
            'item_manufacturer_id' => 'Производитель',
            'item_parent_id' => 'Item Parent',
            'item_status_id' => 'Item Status',
            'item_name' => 'Item Name',
            'item_short_description' => 'Item Short Description',
            'item_full_description' => 'Item Full Description',
            'item_description' => 'Item Description',
            'item_meta_description' => 'Item Meta Description',
            'item_meta_keywords' => 'Item Meta Keywords',
            'item_page_title' => 'Item Page Title',
            'item_rating' => 'Item Rating',
            'item_order' => 'Item Order',
            'created' => 'Created',
            'creator_id' => 'Creator',
            'edition' => 'Edition',
            'editor_id' => 'Editor',
        );
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
        foreach (self::$relatedModel as $valueModel) {
           $valueModel::model()->deleteAll(array("condition" => "item_id=:item_id", "params" => array(":item_id" => $this->item_id)));
        }
    }
    
    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $maxparent = Yii::app()->db->createCommand()
                        ->select('max(item_order) as max')
                        ->from('catalog_item')
                        ->where('item_parent_id=:parent_id', array(':parent_id' => $this->item_parent_id))
                        ->queryRow();

                $this->item_order = $maxparent["max"] + 1;
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

    public function getBreadcrumb($array) {
        if (!$this->isNewRecord) {
            $array[] = array("name" => $this->item_name, "action" => "");
        }
        $model = Essence::model()->findByPk($this->item_parent_id);
        return $model->getBreadcrumb($array);
    }

    public function ifSaveManufactured($manufact) {
        if (!$model = Manufacturer::model()->find("manufacturer_name=:manufacturer_name", array(":manufacturer_name" => $manufact))) {
            $model = new Manufacturer();
            $model->manufacturer_name = $manufact;
            $model->save();
        }
        echo $this->item_manufacturer_id = $model->manufacturer_id;
    }

}