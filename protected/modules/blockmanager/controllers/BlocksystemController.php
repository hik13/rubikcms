<?php

class BlockSystemController extends BlockparentController {

    protected $basicRigth = "manageSystemBlock";
    protected $typeblock = 1;
    protected $url_string = "/blockmanager/blocksystem/";

    public function init() {
        parent::init();
        $this->addBreadcrumb(array("name" => Translater::getDictionary()->blockmanagersystemName, "action" => $this->createUrl("/blockmanager/blocksystem/")));
    }

}

