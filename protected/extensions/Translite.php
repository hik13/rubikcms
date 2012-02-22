<?php

class Translite {

    static private $tbl = array(
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
        'е' => 'e', 'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i',
        'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
        'у' => 'u', 'ф' => 'f', 'х' => 'kh', 'ц' => 'tc', 'ч' => 'ch',
        'ш' => 'sh', 'щ' => 'shc', 'ы' => 'y', 'э' => 'e', 'ъ' => '',
        'ь' => '', 'ю' => 'yu', 'я' => 'ya',
        ' ' => '-',);

    static function TranslitIt($str) {
        $str = mb_strtolower($str, "utf-8");
        $str = strtr($str, self::$tbl);
        $str = preg_replace('#[^A-Za-z1-9.\/-]#', '', $str);
        $str = preg_replace('#(\__|){2,}#', '', $str);
        return $str;
    }

}

?>