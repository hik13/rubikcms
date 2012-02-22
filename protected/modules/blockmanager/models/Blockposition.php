<?php

/**
 * @property integer $position_id
 * @property string $position_code
 * @property string $position_desk
 */
class BlockPosition extends CMyActiveRecord {

    protected $cache = array("position");

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'block_position';
    }

    public function rules() {

        return array(
            array('position_code,position_desk', 'required'),
            array('position_code', 'length', 'max' => 64),
            array('position_desk', 'length', 'max' => 128),
        );
    }

    public function relations() {
        return array(
            'contentrelation' => array(self::BELONGS_TO, 'ContentBlockRelation', 'relation_block_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'position_code' => Translater::getDictionary()->blockmanagermanagePositionCode,
            'position_desk' => Translater::getDictionary()->blockmanagermanagePositionDesc,
        );
    }

    protected function afterDelete() {
        parent::afterDelete();
        $command = Yii::app()->db->createCommand();
        $command->update(Block::model()->tableName(), array('block_position_id' => '0',), 'block_position_id=:id', array(':id' => $this->position_id));
        $command->update(Banner::model()->tableName(), array('block_position_id' => '0',), 'block_position_id=:id', array(':id' => $this->position_id));
    }

}