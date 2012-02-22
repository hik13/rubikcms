<?php

/**

 * The followings are the available columns in table 'related_content':
 * @property integer $related_content_0
 * @property integer $related_content_1
 */
class RelatedContent extends CMyActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'related_content';
    }

    public function rules() {
        return array(
            array('related_content_0, related_content_1', 'required'),
            array('related_content_0, related_content_1', 'numerical', 'integerOnly' => true),
            array('related_content_0, related_content_1', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
        );
    }

    public static function saveRelated($content_id, $related_array) {
        $array1 = Yii::app()->db->createCommand()
                ->select("related_content_0 as id")
                ->from('related_content')
                ->where("related_content_1='$content_id'")
                ->queryAll();
        $array2 = Yii::app()->db->createCommand()
                ->select("related_content_1 as id")
                ->from('related_content')
                ->where("related_content_0='$content_id'")
                ->queryAll();
        $result = array_merge($array1, $array2);
        $ar=array();
        foreach ($result as $rez) {
            $ar[] = $rez["id"];
        }
        $common = array_intersect($related_array, $ar);
        $add_relation = array_diff($related_array, $common);
        $del_relation = array_diff($ar, $common);
        foreach ($add_relation as $key => $value) {
            if (!empty($value)) {
                $nodes = Yii::app()->db->createCommand()
                        ->select("locale_id")
                        ->from("content")
                        ->where("content_id in ('$value','$content_id')")
                        ->queryAll();
                if ($nodes[0] != $nodes[1]) {
                    $model = new RelatedContent();
                    $model->related_content_0 = $content_id;
                    $model->related_content_1 = $value;
                    $model->save();
                }
            }
        }
        foreach ($del_relation as $key => $value) {
            $comma=Yii::app()->db->createCommand();
            $comma->delete("related_content","(related_content_0='$value' AND related_content_1='$content_id') 
                             OR (related_content_0='$content_id' AND related_content_1='$value')"); 
        }
    }

    public static function getRelatedContent($id, $current_locale_id) {
        $what = "rc.related_content_0,rc.related_content_1,c.locale_id";
        $condition = "(rc.related_content_0=$id OR rc.related_content_1=$id ) and c.locale_id<>$current_locale_id";
        $nodes = Yii::app()->db->createCommand()
                ->select($what)
                ->from("related_content rc")
                ->where($condition)
                ->leftJoin("content c", "rc.related_content_0=c.content_id or rc.related_content_1=c.content_id")
                ->queryAll();
        $array = array();
        foreach ($nodes as $node) {
            $array[$node["locale_id"]] = $node["related_content_0"] == $id ? $node["related_content_1"] : $node["related_content_0"];
        }
        return array_flip($array);
    }

}