<?php

class CMyConfiguration extends CConfiguration {

    public function saveTxtToFile($filePatch) {
        $message.="<?php \n return Array( \n";
        foreach ($this->toArray() as $key => $value) {
            $message.=$this->retText($key, $value);
        }
        $message.="); \n ?> \n";
        $file = fopen($filePatch, "w+");
        fwrite($file, $message);
        fclose($file);
    }

    private function retText($key, $value, $t=0) {
        for ($i = 0; $i <= $t; $i++) {
            $tab.="\t";
        }
        if (!is_array($value)) {
            $message = $tab . "\"" . $key . "\" => \"" . $value . "\", \n";
        } else {
            $t++;
            $message = $tab . "\"" . $key . "\" =>array( \n";
            foreach ($value as $keyI => $valueI)
                $message.=$this->retText($keyI, $valueI, $t);
            $message.=$tab . "), \n";
        }
        return $message;
    }

}

?>