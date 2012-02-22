<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->getTheme()->getBaseUrl() . '/css/layout.css'); ?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->getTheme()->getBaseUrl() . '/css/default-theme.css'); ?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->getTheme()->getBaseUrl() . '/css/admin-toolbar.css'); ?>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->getTheme()->getBaseUrl() ?>/theme-images/favicon.png" />
        <!--[if IE 6]>
        <link rel="stylesheet" type="text/css"  href="<?php echo Yii::app()->getTheme()->getBaseUrl() ?>/css/ie-6.css" >
        <![endif]-->	
		
	<!--[if lt IE 9]>
        <link rel="stylesheet" type="text/css"  href="<?php echo Yii::app()->getTheme()->getBaseUrl()?>/css/css3-behavior.css" >
        <![endif]-->
        <?php Yii::app()->clientScript->registerCoreScript('livejquery'); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->getTheme()->getBaseUrl() . '/js/private/main.js', CClientScript::POS_HEAD); ?>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>
        <div class="page-wrapper">
            <div class="page clearfix <?php echo $this->module->setting["class"]; ?>">                             
                <?php $this->renderPartial("//common/pageblock/admin-toolbar", array("adminka" => true)); ?>
                <?php $this->renderPartial('//common/pageblock/header'); ?>
                <?php $this->renderPartial('//common/pageblock/blockBreadcrumbs', array('crumbs' => $this->breadcrumb)); ?>
                <?php $this->renderPartial('//common/pageblock/main-content', array('content' => $content)); ?>
            </div>
        </div>
        <?php $this->renderPartial('//common/pageblock/footer', array()); ?>
    </body>

</html>


