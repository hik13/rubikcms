<?php

class MysqlDumper {
    static private $dump_file ="dump/dump.sql";


    static public function initDumpFile() {
        return $_SERVER["DOCUMENT_ROOT"]."/".self::$dump_file;

    }

    static public function CreateDump() {
        $dump_dir =$_SERVER["DOCUMENT_ROOT"]."/dump";
        $tables = Yii::app()->db->createCommand("SHOW TABLES")->queryAll();
        $fp = fopen(self::initDumpFile(),"a");
        if ( $fp ) {
            foreach ($tables as $table) {
                $query = "TRUNCATE TABLE `".$table["Tables_in_cms_db"]."`;\n";
                fwrite ($fp, $query);
                $rows = Yii::app()->db->createCommand('SELECT * FROM `'.$table["Tables_in_cms_db"].'`')->queryAll();
                foreach ($rows as $row) {
                    $query = "";
                    foreach ( $row as $field ) {
                        if ( is_null($field) )
                            $field = "NULL";
                        else
                            $field = "'$field'";
                        if ( $query == "" )
                            $query = $field;
                        else
                            $query = $query.', '.$field;
                    }
                    $query = "INSERT INTO `".$table["Tables_in_cms_db"]."` VALUES (".$query.");\n";
                    fwrite ($fp, $query);
                }
            }

        }
        fclose ($fp);
    }


    static public function ExecuteDump() {
        $fname=self::initDumpFile();
        if (!file_exists($fname)) die ("Файл $fname не существует!");
        $fp = fopen ($fname, "r");
        $buffer = fread($fp, filesize($fname));
        fclose ($fp);
        $prev = -1;
        while ($next = strpos($buffer,"\n",$prev+1)) {
            $i++;
            $a = substr($buffer,$prev+1,$next-$prev);
            Yii::app()->db->createCommand($a)->execute();
            $prev = $next;
        }
        echo "Выполнено $i команд";
    }

}

?>

