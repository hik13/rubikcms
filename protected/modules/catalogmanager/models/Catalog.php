<?php

/**
 * @property integer $catalog_id
 * @property string  $catalog_name
 * @property integer $catalog_status_id
 * @property integer $catalog_version_id
 * @property integer $catalog_display_on
 */
class Catalog extends CMyActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'catalog';
    }

    public function rules() {
        return array(
            array('catalog_name', 'required'),
            array('catalog_status_id, catalog_version_id, catalog_display_on', 'numerical', 'integerOnly' => true),
            array('catalog_name', 'length', 'max' => 256),
        );
    }

    public function relations() {
        return array(
            'cat' => array(self::HAS_MANY, 'Category', 'category_catalog_id'),
            'essence' => array(self::HAS_MANY, 'Essence', 'essence_catalog_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'catalog_name' => Translater::getDictionary()->catalogmanagerCatalogName,
            'catalog_status_id' => Translater::getDictionary()->fieldStatus,
            'catalog_version_id' => Translater::getDictionary()->fieldVersion,
            'catalog_display_on' => Translater::getDictionary()->catalogmanagerCatalogDisplayOn,
        );
    }

    protected function afterSave() {
        parent::afterSave();
        if (!($relation = ContentModuleRelation::model()->find("relation_content_id=?", Array($this->catalog_display_on)))) {
            $relation = new ContentModuleRelation();
            $relation->relation_module_id = "M-CTM";
            $relation->relation_module_object_id = $this->catalog_id;
        }
        $relation->relation_content_id = $this->catalog_display_on;
        $relation->save();
    }

    protected function afterDelete() {
        parent::afterDelete();
        $this->deleteRelation($this->catalog_id);
    }

}