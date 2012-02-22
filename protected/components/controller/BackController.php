<?php

class BackController extends BackParentController {

    public $layout = '//layouts/backControllerLayout';
    public $breadcrumb = array();
    public $punkts = array();
    protected $basicRigth;

    public function init() {
        parent::init();
        if (Yii::app()->user->isGuest) {
            $this->redirect("/login");
        } else {
            $this->setUserGroupState();
        }
        $this->pageTitle = Translater::getDictionary()->adminTitle;
    }

    public function filters() {
        return array(
            'BasicActionsFilter + index,create,update,delete',
        );
    }

    public function filterBasicActionsFilter($filterChain) {
        if ($this->checkAccess($this->basicRigth)) {
            $filterChain->run();
        } else {
            echo "Not have permission for rigth";
        }
    }

    public function addBreadcrumb(array $array) {
        foreach ($array as $command) {
            if (is_array($command)) {
                $this->addBreadcrumb($command);
            } else {
                $this->breadcrumb[] = $array;
                break;
            }
        }
    }

    public function getclassError($key, array $arrayError) {
        return in_array($key, array_keys($arrayError)) ? "error-form-border" : "";
    }

    protected function setUserGroupState() {
        $permission = UserIdentity::getPermissionByGroupId(Yii::app()->user->getState("group"));
        Yii::app()->user->setState('permission', $permission);
    }

}

?>