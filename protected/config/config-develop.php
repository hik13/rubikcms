<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    // 'class'=>"CWebApplication",
    'name' => 'My Web Application',
    'sourceLanguage' => 'en_US',
    'language' => 'ru',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.components.redefined.*',
        'application.components.controller.*',
        'application.components.based.*',
        'application.extensions.*',
        'application.models.*',
        'application.modules.contentmanager.models.*',
        'application.modules.modulemanager.models.*',
    ),
    'theme' => 'rubicsms',
    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'hik13',
            'ipFilters' => array('192.168.8.205'),
        ),
        'blockmanager', 'catalogmanager', 'contentmanager',
        'feedsmanager', 'translatemanager', 'modulemanager',
        'seomanager', 'usermanager', 'bannermanager',
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'loginUrl' => array('/login'),
        ),
        // uncomment the following to enable URLs in path-format
        'CDbConnection' => array('enableProfiling' => true),
        'urlManager' => array(
            'urlFormat' => 'path',
            // 'urlSuffix'=>'.html',
            'showScriptName' => false,
            // 'baseUrl'=>'/',
            'rules' => array(
                'gii' => 'gii',
                'gii/<controller:\w+>' => 'gii/<controller>',
                'gii/<controller:\w+>/<action:\w+>' => 'gii/<controller>/<action>',
                '404/' => 'content/404',
                'instal/' => 'content/instal',
                'test/*' => 'test/index',
                '<_a:(login|logout)>' => 'avtorization/<_a>',
                'instal/' => 'avtorization/instal',
                'management/<module:\w+>/<controller:\w+>/<action:\w+>/*' => '<module>/<controller>/<action>',
                'management/<module:\w+>/<controller:\w+>*' => '<module>/<controller>',
                'management/<m:>*' => '<m>',
                array('class' => 'application.components.redefined.CMyUrlRulez'),
            ),
        ),
        /*  SqLite
          'db'=>array(
          'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
          ),
         */

        // uncomment the following to use a MySQL database
        'db' => array(
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=localhost;dbname=qa.mobi',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            //logging
            'enableProfiling' => true,
            'enableParamLogging' => true,
            //cache
            'schemaCacheID' => 'cache',
            'queryCacheID' => 'cache',
            'schemaCachingDuration' => 3600,
        ),
        //
        'cache' => Array('class' => 'application.components.redefined.CMyFileCache'),
        'errorHandler' => array(
            'class' => 'CErrorHandler',
            // use 'site/error' action to display errors
            'errorAction' => '/contentmanager/content/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'enabled' => YII_DEBUG,
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                array(
                    'class' => 'application.extensions.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters' => array('127.0.0.1', '192.168.1.215'),
                ),
            /*
              array(
              'class'=>'CFileLogRoute',
              'levels'=>'error, warning',
              'showInFireBug'=>true,
              ),

              array(
              'class'=>'CWebLogRoute',
              ),


              array( 'class'=>'CProfileLogRoute',
              'enabled'=>true,
              'levels'=>'profile',
              'showInFireBug'=>true,
              ),

              array(
              'class'=>'CProfileLogRoute',
              'categories' => 'application',
              'levels'=>'error, warning, trace, profile, info',
              ), */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        'mainTitle' => "Qulix QA",
        'mainTheme' => "qa",
        'adminTheme' => "rubicsms",
        'mainAdminpage' => "/management/contentmanager/content",
        'adminEmail' => 'webmaster@example.com',
        'superUser' => array("login" => "SU", "password" => 13),
    ),
);