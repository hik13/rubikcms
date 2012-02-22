<?php

/**
 * @property integer $dimension_group_id
 * @property integer $dimension_group_locale_id
 * @property string $dimension_group_name
 */
class DimensionGroup extends CActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'catalog_dimension_group';
    }

    public function rules() {
        return array(
            array('dimension_group_locale_id', 'numerical', 'integerOnly' => true),
            array('dimension_group_name', 'length', 'max' => 200),
            array('dimension_group_id, dimension_group_locale_id, dimension_group_name', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'units' => array(self::HAS_MANY, 'Dimension', 'dimension_group_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'dimension_group_name' => Translater::getDictionary()->catalogmanager_dimensionGroupName,
        );
    }

    
    protected function afterDelete() {
        parent::afterDelete();
        $this->deleteRelation($this->category_id);
    }
        
}