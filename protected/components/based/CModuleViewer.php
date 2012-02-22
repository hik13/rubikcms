<?php

abstract class CModuleViewer extends CController {

    public function __construct() {
        
    }

    abstract public function getRelatedContent(ContentModuleRelation $object, $locale_id);
}

?>
