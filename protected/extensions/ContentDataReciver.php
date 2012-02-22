<?php

class ContentDataReciver {

    static public $curent_locale;

    static public function getModelByContentId($id=false) {
        if (isset($_GET["locale_id"])) {
            $locale = Locale::model()->find("locale_code=:locale_code", array(":locale_code" => $_GET["locale_id"]));
        } else {
            $locale = Locale::model()->find("locale_default='1'");
        }
        if ($id) {
            $model = Content::model()->find('textlink=:textlink and locale_id=:locale_id ', array(':textlink' => $id, ":locale_id" => $locale->locale_id));
        } else {
            $model = Content::model()->find('main_page=:main_page and locale_id=:locale_id', array(':main_page' => 1, ':locale_id' => $locale->locale_id));
        }
        self::$curent_locale = $locale;
        FrontTranslater::setCurrentLocale($locale->locale_code);
        FrontTranslater::setDictionary(Yii::app()->getTheme()->getBasePath() . "/translate", "messages");
        if ($model) {
            if ($relation = Contentmodulerelation::model()->find("relation_content_id=?", Array($model->content_id))) {
                $model->content = $model->content . $relation->getModuleContent($locale->locale_id);
            }
            Yii::import("application.modules.seomanager.models.*", true);
            $model = Seo::seoAnalyz($model);
            return $model;
        } else {
            return false;
        }
    }

    static public function getPositionContent(Content $content) {
        $array = array();
        Yii::import("application.modules.blockmanager.models.*", true);
        $nodes = Yii::app()->db->createCommand()
                ->select("b.block_content,b.block_system,b.block_dependies,
                    ban.banner_date_to,ban.banner_priority,ban.banner_type,ban.banner_url,ban.banner_pattern,
                    cbr.relation_block_type,bp.position_code")
                ->from("content_block_relation as cbr")
                ->leftJoin("block as b", "b.block_id=cbr.relation_block_id and b.block_status='1' and cbr.relation_block_type='0'")
                ->leftJoin("banner as ban", "ban.banner_id=cbr.relation_block_id and ban.banner_status='1' and cbr.relation_block_type='1'")
                ->leftJoin("block_position  as bp", "bp.position_id=b.block_position_id or bp.position_id=ban.banner_position_id")
                ->order("b.block_order,ban.banner_order")
                ->where("cbr.relation_content_id='$content->content_id'")
                ->queryAll();
        if (!empty($nodes)) {
            foreach ($nodes as $noda) {
                $info = @unserialize($noda["block_content"]) !== false ? unserialize($noda["block_content"]) : $noda["block_content"];
                if ($noda["relation_block_type"] == 0) {
                    if ($noda["block_system"]) {
                        $array[$noda["position_code"]].=eval($info[$content->locale_id]["block_system_php"]);
                        $array[$noda["position_code"]].=$info[$content->locale_id]["block_system_html"];
                    } else {
                        $array[$noda["position_code"]].=$info[$content->locale_id];
                    }
                    if (@unserialize($noda["block_dependies"]))
                        Uploader::registrFile(unserialize($noda["block_dependies"]));
                } else {
                    if ($noda["banner_date_to"] >= Time::getCurrentTime()) {
                        if ($noda["banner_priority"]) {
                            $arrayOfRandomBanner[$noda["position_code"]][] = Banner::getHtmlBanner($noda["banner_type"], $noda["banner_url"], $noda["banner_pattern"]);
                        } else {
                            $array[$noda["position_code"]].=Banner::getHtmlBanner($noda["banner_type"], $noda["banner_url"], $noda["banner_pattern"]);
                        }
                    }
                    foreach ($arrayOfRandomBanner as $key => $value) {
                        $randBanner = array_rand($value);
                        $array[$key].=$value[$randBanner];
                    }
                }
            }
        }
        return $array;
    }
}

?>