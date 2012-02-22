<?php

/**
 * @property integer $dimension_id
 * @property integer $dimension_group_id
 * @property string $dimension_name
 * @property string $dimension_cut
 * @property double $dimension_coefficient
 * @property integer $dimension_base
 */
class Dimension extends CMyActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'catalog_dimension';
    }

    public function rules() {
        return array(
            array('dimension_coefficient,dimension_group_id', 'numerical'),
            array('dimension_name', 'length', 'max' => 200),
            array('dimension_cut', 'length', 'max' => 10),
            array('dimension_base', 'boolean'),
        );
    }

    public function relations() {
        return array();
    }

    public function attributeLabels() {
        return array(
            'dimension_group_id' => Translater::getDictionary()->catalogmanager_dimensionGroup,
            'dimension_name' => Translater::getDictionary()->catalogmanager_dimensionName,
            'dimension_cut' => Translater::getDictionary()->catalogmanager_dimensionCut,
            'dimension_coefficient' => Translater::getDictionary()->catalogmanager_dimensionCoefficient,
            "dimension_base" => Translater::getDictionary()->catalogmanager_dimensionBase,
        );
    }

    
    protected function afterDelete() {
        parent::afterDelete();
        $command = Yii::app()->db->createCommand();
        $command->update(Parameter::model()->tableName(), array('parameter_dimension_id' => '0',), 'parameter_dimension_id=:id', array(':id' => $this->dimension_id));
    }
    
    
}