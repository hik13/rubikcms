<?php

class FeedsRSSController extends BackController {

    protected $basicRigth = "manageFeeds";

    public function init() {
        parent::init();
        $this->breadcrumb = array(
            array("name" => Translater::getDictionary()->feedsmanager_name, "action" => $this->createUrl("/feedsmanager/feedsrss/")),
        );
    }

    public function actionIndex() {
        $model = new Feeds();
        $criteria = new CDbCriteria;
        $criteria->addCondition('feed_rss IS NOT NULL');
        $this->render('index', array('feeds' => $model->findAll($criteria)));
    }

    public function actionCreate() {
        $list = new Feeds;
        $criteria = new CDbCriteria;
        $criteria->addCondition('feed_rss IS NULL');
        $list = $this->getDropDownArray($list->findAll($criteria), NULL);
        if ((isset($_POST['RSS'])) && ($_POST['RSS']['feeds'] != 0)) {
            $model = Feeds::model()->findByPk($_POST['RSS']['feeds']);
            $model->feed_rss = $_POST['RSS'];
            if ($model->save()) {
                $this->redirect(array('index'));
            }
        }
        $this->render('create', array('model' => $model, 'list' => $list));
    }

    public function actionUpdate($id) {
        $model = Feeds::model()->findByPk($id);
        $list = new Feeds();
        $criteria = new CDbCriteria;
        $criteria->addCondition('feed_rss IS NULL');
        $list = $this->getDropDownArray($list->findAll($criteria), $model);
        if ((isset($_POST['RSS'])) && ($_POST['RSS']['feeds'] != 0)) {
            $model = Feeds::model()->findByPk($_POST['RSS']['feeds']);
            $model->feed_rss = $_POST['RSS'];
            if ($model->save()) {
                $this->redirect(array('index'));
            }
        }

        $this->render('update', array('model' => $model, 'list' => $list));
    }

    public function actionDelete($id=false) {
        if ($id) {
            $model = Feeds::model()->findByPk($id);
            $rssFile = "http://" . $_SERVER['SERVER_NAME'] . "/site/rss/" . $this->feed->feed_rss['name'] . ".xml";
            if (is_file($rssFile)) {
                unlink($rssFile);
            }
            $model->feed_rss = NULL;
            if ($model->save()) {
                $this->redirect(array('index'));
            }
        }
        $this->redirect(array('index'));
    }

    protected function getDropDownArray($feeds, $start) {
        if (isset($feeds)) {
            if ($start) {
                $array[$start->feed_id] = $start->feed_name;
            }
            foreach ($feeds as $feed) {
                $key = $feed->feed_id;
                $value = $feed->feed_name;
                $array[$key] = $value;
            }
        } else {
            $array[0] = "Not found";
        }
        return $array;
    }

}

