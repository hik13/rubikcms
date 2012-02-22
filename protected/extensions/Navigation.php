<?php

class Navigation {

    static private $setsValue = array("active_reset" => false, "new_active" => false);
    static public  $bredcrumbArray;

    static public function returnMenus($current_id) {
        $array = Cache::getDataCashe("menu_object_" . ContentDataReciver::$curent_locale->locale_id, "Navigation", "returnMenuWithChild", array($current_id));
        $array = self::setActivePunkt($current_id, $array);
        self::returnBreadcrumb($array);
        $a_array["main-menu"] = $array;
        $a_array["sub-menu"] = self::returnSubMenu($current_id, $array);
        $a_array["breadcrumb"] = self::$bredcrumbArray;
        return $a_array;
    }

    static public function returnMenuWithChild($current_id) {
        $criteria = new CDbCriteria;
        $criteria->condition = 't.parent_id=:parent_id and t.locale_id=:locale_id and t.content_nonstructur=:content_nonstructur and t.status_id=:status_id';
        $criteria->params = array(':parent_id' => 0, ':locale_id' => ContentDataReciver::$curent_locale->locale_id, ':content_nonstructur' => 0, ':status_id' => 1);
        $criteria->order = 't.content_order';
        $models = Content::model()->with("child")->findAll($criteria);
        $list = self::returnTreeList($current_id, $models);
        return $list;
    }

    static private function returnSubMenu($current_active_id, $array, $i=0) {
        $result = array();
        foreach ($array as $key => $punkt) {
            if ($current_active_id === $punkt["item"]["id"]) {
                if (!empty($punkt["child"])) {
                    return $punkt["child"];
                } else {
                    return $i === 0 ? array() : $array;
                }
            } else if (!empty($punkt["child"])) {
                $result = self::returnSubMenu($current_active_id, $punkt["child"], ++$i);
                if (!empty($result)) {
                    return $result;
                }
            }
        }
        return $result;
    }

    static private function returnTreeList($current_id, $models) {
        $treelist = array();
        $i = 0;
        if (!empty($models))
            foreach ($models as $model) {
                if ($model->status_id) {
                    if (!$model->content_nonstructur) {
                        $treelist[$i]["id"] = $model->content_order;
                        $treelist[$i]["item"] = array(
                            "title" => $model->name,
                            "main-page" => $model->main_page,
                            "not_show_in_menu" => $model->not_show_in_menu,
                            "empty" => $model->empty_link,
                            "id" => $model->content_id,
                            "link" => empty($model->content_redirectlink) ? ContentDataReciver::$curent_locale->locale_default == 1 ? "/" . $model->textlink : "/" . ContentDataReciver::$curent_locale->locale_code . "/" . $model->textlink  : $model->content_redirectlink,
                            "active" => $current_id == $model->content_id ? true : false);
                        $treelist[$i]["not_tree"] = self::returnNotTreeList($current_id, $model->child);
                        $treelist[$i]["child"] = self::returnTreeList($current_id, $model->child);
                    }
                }
                $i++;
            }
        return $treelist;
    }

    static private function returnNotTreeList($current_id, $models) {
        $treelist = array();
        if (!empty($models))
            foreach ($models as $model) {
                if ($model->status_id) {
                    if ($model->content_nonstructur) {
                        $treelist[$model->content_order]["id"] = $model->content_order;
                        $treelist[$model->content_order]["item"] = array(
                            "title" => $model->name,
                            "main-page" => $model->main_page,
                            "not_show_in_menu" => true,
                            "empty" => $model->empty_link,
                            "id" => $model->content_id,
                            "link" => empty($model->content_redirectlink) ? ContentDataReciver::$curent_locale->locale_default == 1 ? "/" . $model->textlink : "/" . ContentDataReciver::$curent_locale->locale_code . "/" . $model->textlink  : $model->content_redirectlink,
                            "active" => $current_id == $model->content_id ? true : false);
                    }
                }
            }
        return $treelist;
    }

    static private function setActivePunkt($current_active_id, $array) {
        foreach ($array as $key => $punkt) {
            if (self::$setsValue["new_active"] && self::$setsValue["active_reset"])
                break;
            else {
                if ($punkt["item"]["active"]) {
                    if ($current_active_id === $punkt["item"]["id"]) {
                        self::$setsValue["new_active"] = true;
                        self::$setsValue["active_reset"] = true;
                        return $array;
                    } else {
                        $array[$key]["item"]["active"] = false;
                        self::$setsValue["active_reset"] = true;
                    }
                } else if ($current_active_id === $punkt["item"]["id"]) {

                    $array[$key]["item"]["active"] = true;
                    self::$setsValue["new_active"] = true;
                }
                if (!empty($punkt["child"])) {
                    $array[$key]["child"] = self::setActivePunkt($current_active_id, $punkt["child"]);
                }
                if (!empty($punkt["not_tree"])) {
                    $array[$key]["not_tree"] = self::setActivePunkt($current_active_id, $punkt["not_tree"]);
                }
            }
        }
        return $array;
    }

    static private function returnBreadcrumb($menu) {
        foreach ($menu as $el) {
            if ($el["item"]["active"]) {
                self::$bredcrumbArray[] = array("name" => $el["item"]["title"], "href" => $el["item"]["link"], "empty" => $el["item"]["empty"]);
                return true;
            } else if (!empty($el["child"])) {
                if (self::returnBreadcrumb($el["child"])) {
                    self::$bredcrumbArray[] = array("name" => $el["item"]["title"], "href" => $el["item"]["link"], "empty" => $el["item"]["empty"]);
                    return true;
                }
            }
            if (!empty($el["not_tree"])) {
                if (self::returnBreadcrumb($el["not_tree"])) {
                    self::$bredcrumbArray[] = array("name" => $el["item"]["title"], "href" => $el["item"]["link"], "empty" => $el["item"]["empty"]);
                    return true;
                }
            }
        }
        return false;
    }
}
?>
