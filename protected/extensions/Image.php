<?php

 class Image {

     static public $quality=93;
     
     
     public static function uploadedImageCheck($filesinfo, $imagewidth, $imageheight) {
        if (!$imageInfo = getimagesize($filesinfo["tmp_name"])) {
            ResponseAjax::setResponseError(Translater::getDictionary()->errorTypeImageUpload);
            return false;
        }
        if (($imageInfo[0] < $imagewidth) or ($imageInfo[1] < $imageheight)) {
            ResponseAjax::setResponseError(Translater::getDictionary()->errorDimensionImageUpload);
            return false;
        }
        return true;
    }

    
    public static function resizeAndUpload($file_input, $file_output, $w_o, $h_o, $percent = false) {
        list($w_i, $h_i, $type) = getimagesize($file_input);
        if (!$w_i || !$h_i) {
            echo 'Невозможно получить длину и ширину изображения';
            return;
        }
        $types = array('', 'gif', 'jpeg', 'png');
        $ext = $types[$type];
        if ($ext) {
            $func = 'imagecreatefrom' . $ext;
            $img = $func($file_input);
        }
        if ($percent) {
            $w_o *= $w_i / 100;
            $h_o *= $h_i / 100;
        }
        if (!$h_o)
            $h_o = $w_o / ($w_i / $h_i);
        if (!$w_o)
            $w_o = $h_o / ($h_i / $w_i);
        
        if (($h_o==$h_i) and ($w_o==$w_i)) {
            return copy($file_input, $file_output);
        } 
        $img_o = imagecreatetruecolor($w_o, $h_o);
        imagecopyresampled($img_o, $img, 0, 0, 0, 0, $w_o, $h_o, $w_i, $h_i);
        if ($type == 2) {
            return imagejpeg($img_o, $file_output, self::$quality);
        } else {
            $func = 'image' . $ext;
            return $func($img_o, $file_output);
        }
    }
    
    public static function analyzSizesAndReturn($notBiggest, array $sizes) {
        $returned_size = 0;
        foreach ($sizes as $size) {
            $a[] = $size["width"];
        }
        asort($a);
        foreach ($a as $key => $value) {
            if ($value > $notBiggest) {
                return $key == 0 ? $a[0] : $a[$key - 1];
            }
            if ($key == (count($a) - 1)) {
                return $value;
            }
        }
    }
    
    
    
}
?>
