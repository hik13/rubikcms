<?php

class Viewer extends CModuleViewer {

    public static $nameVarPaging = "feed_page";
    public static $nameVarFullObj = "full_feed";
    private $feed;
    private $fields;
    private $relation;
    private $condition = "";

    public function getRelatedContent(ContentModuleRelation $object, $locale_id) {
        $this->relation = $object;
        $path = "application.modules.feedsmanager.models.*";
        Yii::import($path, true);
        $path = "application.modules.feedsmanager.components.*";
        Yii::import($path, true);
        $this->feed = Feeds::model()->findByPk($this->relation->relation_module_object_id);
        if ($this->feed->feed_status == 1) {
            $this->fields = Cache::getDataCashe("feed_fields_" . $object->relation_module_object_id, $this, "getFields", array($this->relation->relation_module_object_id));
            $this->createCondition(unserialize($this->relation->relation_module_condition));
            return $this->getFeedContent($locale_id);
        } else {
            return "";
        }
    }

    public function getRelatedContentByCondition(ContentModuleRelation $object, $condition, $locale_id) {
        $this->relation = $object;
        $path = "application.modules.feedsmanager.models.*";
        Yii::import($path, true);
        $path = "application.modules.feedsmanager.components.*";
        Yii::import($path, true);
        $this->feed = Feeds::model()->findByPk($this->relation->relation_module_object_id);
        if ($this->feed->feed_status == 1) {
            $this->fields = Cache::getDataCashe("feed_fields_" . $object->relation_module_object_id, $this, "getFields");
            $this->createCondition(array($condition));
            return $this->getFeedContent($locale_id);
        }
    }

    private function createCondition($array_condition) {
        if (!empty($array_condition)) {
            foreach ($array_condition as $cond) {
                $condition = $condition . "feed_object_category LIKE '%$cond%' or ";
            }
            $condition = substr($condition, 0, -3);
            $this->condition = "and " . $condition;
        }
    }

    public function getFields($id) {
        $fields = Yii::app()->db->createCommand
                        ("SELECT field_feeds_value.field_feed_id as id ,
                                 field_feeds_value.field_value as label,
                                 field_type_property.field_type_id as type
                          FROM field_feeds_value 
                          LEFT JOIN field_type_property 
                          ON field_feeds_value.property_id=field_type_property.property_id
                          WHERE field_feeds_value.field_feed_id IN
                                              (SELECT field_feeds.field_feed_id
                                              FROM field_feeds
                                              WHERE field_feeds.feed_id = '{$id}')
                          AND field_feeds_value.property_id IN
                                              (SELECT field_type_property.property_id
                                               FROM field_type_property
                                               WHERE property_name_id = 'template_name')")->queryAll();
        foreach ($fields as $f) {
            $array[$f["id"]]["label"] = $f["label"];
            $array[$f["id"]]["type_id"] = $f["type"];
        }
        return $array;
    }

    private function getFeedContent($locale_id) {
        $offset = 0;
        if (!isset($_GET[self::$nameVarFullObj])) {
            if ((!isset($_GET[self::$nameVarPaging])) or ($_GET[self::$nameVarPaging] == 1)) {
                $_GET[self::$nameVarPaging] = 1;
            } else {
                $offset = ($_GET[self::$nameVarPaging] - 1) * $this->feed->on_page;
            }
            $objects = Feedsobject::model()->findAll(
                    array("select" => "feed_object_id",
                        "limit" => $this->feed->on_page,
                        "offset" => $offset,
                        "order" => $this->feed->sort_by["sort"] . " " . $this->feed->sort_by["desc"],
                        "condition" => "feed_id=:id and status_id=:status $this->condition",
                        "params" => array(":id" => $this->feed->feed_id, ":status" => 1),
                    ));
            foreach ($objects as $object) {
                $in.=$object->feed_object_id . ",";
            }
            $in = substr($in, 0, -1);
            $values = Feedsobjectvalue::model()->findAll(
                    array(
                        "condition" => "feed_object_id in ($in)",
                        "order" => "feed_object_id"
                    )
            );
            foreach ($values as $value) {
                foreach ($objects as $key => $object) {
                    if ($object->feed_object_id == $value->feed_object_id) {
                        $objects[$key]->addRelatedRecord("values", $value, true);
                        break;
                    }
                }
            }
            $counts = Feedsobject::model()->count(array(
                "condition" => "feed_id=:id and status_id=:status $this->condition",
                "params" => array(":id" => $this->feed->feed_id, ":status" => 1),
                    ));
            if (isset($this->feed->feed_rss)) {
                $url = "http://" . $_SERVER['SERVER_NAME'] . "/site/rss/" . $this->feed->feed_rss['name'] . ".xml";
                $str = '<a href="' . $url . '" class="rssButton"><span></span></a>';
            }
            foreach ($objects as $object) {
                $template = $this->feed->template;
                if (!empty($object->values)) {
                    foreach ($object->values as $value) {
                        $template = Areas::changeTemplate($this->fields, $value, $template, $locale_id);
                    }
                    $str = $str . $template;
                }
            }

            if ($counts > $this->feed->on_page) {
                $link = $_GET["locale_id"] ? $_GET["locale_id"] . "/" . $_GET["id"] : $_GET["id"];
                $array = Paginator::getArrayForPagination($_GET[self::$nameVarPaging], $counts, $this->feed->on_page, $link, self::$nameVarPaging);
                $str = $str . Paginator::getPaginationContent($this, $array);
            }
        } else {
            $object = Feedsobject::model()->with("values")->findByPk($_GET[self::$nameVarFullObj]);
            $template = $this->feed->template;
            if (!empty($object->values)) {
                foreach ($object->values as $value) {
                    Areas::$full = true;
                    $template = Areas::changeTemplate($this->fields, $value, $template, $locale_id);
                }
                $str = $str . $template;
            }
        }
        return $str;
    }

}

?>