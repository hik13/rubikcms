<?php

class CstImagePortfolio {

    static private $type_image = array(
        "0" => "safary",
        "1" => "mobile_240_320",
        "2" => "iphone_252_364",
        "3" => "flash_banner",
        "4" => "none"
    );
    static private $mobresol = array(
        "mobile_240_320" => array("width" => 240, "heigth" => 320),
        "iphone_252_364" => array("width" => 252, "heigth" => 364));

    public static function saveImage($file, $file_name, $_POST, $sizes) {
        foreach ($_POST["FeedObjectValue"] as $key => $value) {
            if ($value["field_feed_id"] == "32") {
                $type = $value["field_feed_value"];
            }
            if ($value["field_feed_id"] == "3") {
                $nameW = $value["field_feed_value"][2];
            }
            if ($value["field_feed_id"] == "2") {
                $linkW = $value["field_feed_value"][2];
            }
        }

        switch (self::$type_image[$type]) {
            case in_array(self::$type_image[$type], array("safary", "flash_banner","none")): {
                    self::saveWeb($file, $file_name, $sizes, self::$type_image[$type], $nameW, $linkW);
                    break;
                };
            case in_array(self::$type_image[$type], array("mobile_240_320", "iphone_252_364")) : {
                    self::saveMobile($file, $file_name, $sizes, self::$mobresol[self::$type_image[$type]]);
                    break;
                }
        }
    }

    private static function saveWeb($file, $file_name, $sizes, $types, $nameW, $linkW) {
        if (is_file($file)) {
            list($w_i, $h_i, $type) = getimagesize($file);
            foreach ($sizes as $size) {
                $file_path = Uploader::getUploadedPatch($size["width"] . "_" . $file_name);
                switch ($size["width"]) {
                    case "560" : {
                            Image::resizeAndUpload($file, $file_path, $size["width"], $size["heigth"]);
                            if ($types == "safary") {
                                $head = $_SERVER['DOCUMENT_ROOT'] . "/uploaded/templates/mak_head.jpg";
                                $foot = $_SERVER['DOCUMENT_ROOT'] . "/uploaded/templates/mac_foot.jpg";
                                $mh = imagecreatefromjpeg($head);
                                $mf = imagecreatefromjpeg($foot);
                                $out = imagecreatefromjpeg($file_path);
                                list($w_t, $h_t, $type) = getimagesize($file_path);
                                list($w_f, $h_f, $type2) = getimagesize($foot);
                                list($w_h, $h_h, $type2) = getimagesize($head);
                                $img_o = imagecreatetruecolor($w_t, $h_t + $h_f + $h_h);
                                imagecopy($img_o, $mh, 0, 0, 0, 0, $w_h, $h_h);
                                imagecopy($img_o, $out, 0, $h_h, 0, 0, $w_t, $h_t);
                                imagecopy($img_o, $mf, 0, $h_h + $h_t, 0, 0, $w_f, $h_f);
                                $color = ImageColorAllocate($img_o, 0, 0, 0); //получаем идентификатор цвета
                                imagettftext($img_o, 7, 0, 66, 25, $color, $_SERVER['DOCUMENT_ROOT'] . "/uploaded/templates/arial.ttf", $linkW);
                                $color = ImageColorAllocate($img_o, 50, 50, 50);
                                $wfrom = $w_f / 2 - (mb_strlen($nameW, 'UTF-8') * 3.8) / 2;
                                imagettftext($img_o, 7, 0, $wfrom, 10, $color, $_SERVER['DOCUMENT_ROOT'] . "/uploaded/templates/arial.ttf", $nameW);
                                imagejpeg($img_o, $file_path, Image::$quality);
                                imagedestroy($mh);
                                imagedestroy($mf);
                                imagedestroy($out);
                                imagedestroy($img_o);
                            }
                            break;
                        }
                    default : {
                            Image::resizeAndUpload($file, $file_path, $size["width"], $size["heigth"]);
                            break;
                        }
                }
            }
        }
    }

    private static function saveMobile($file, $file_name, $sizes, $resolution) {
        if (is_file($file)) {
            list($w_i, $h_i, $type) = getimagesize($file);
            foreach ($sizes as $size) {
                $file_path = Uploader::getUploadedPatch($size["width"] . "_" . $file_name);
                switch ($size["width"]) {
                    case "560" : {
                            if ($w_i > $resolution["width"]) {
                                Image::resizeAndUpload($file, $file_path, $resolution["width"], $resolution["heigth"]);
                            } else {
                                copy($file, $file_path);
                            }
                            break;
                        }
                    case "1024" : {
                            if ($w_i > 1024) {
                                Image::resizeAndUpload($file, $file_path, 1024, 0);
                            } else {
                                copy($file, $file_path);
                            }
                            break;
                        }
                    default : {
                            Image::resizeAndUpload($file, $file_path, $size["width"], $size["heigth"]);
                            break;
                        }
                }
            }
        }
    }

}

?>
