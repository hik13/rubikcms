<?php

class CMyFileCache extends CFileCache {

    public function init() {
        parent::init();
        $this->cachePath = $_SERVER["DOCUMENT_ROOT"] . "/site/runtime/cache";
        if (!is_dir($this->cachePath))
            mkdir($this->cachePath, 0777, true);
    }

}

?>
