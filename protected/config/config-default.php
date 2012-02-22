<?php

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'runtimePath' => $_SERVER["DOCUMENT_ROOT"] . "/site/runtime",
    'theme' => 'rubicsms',
    'import' => array(
        'application.components.redefined.*',
        'application.components.controller.*',
        'application.components.based.*',
        'application.extensions.*',
        'application.models.*',
        'application.modules.contentmanager.models.*',
        'application.modules.modulemanager.models.*',
    ),
    'modules' => array(
        'blockmanager', 'catalogmanager', 'contentmanager',
        'feedsmanager', 'translatemanager', 'modulemanager',
        'seomanager', 'usermanager',
    ),
    'components' => array(
        'assetManager' => array(
            'basePath' => $_SERVER["DOCUMENT_ROOT"] . "/site/assets",
            'baseUrl' => '/site/assets',
        ),
        'themeManager' => array(
            'basePath' => $_SERVER["DOCUMENT_ROOT"] . "/site/themes",
            'baseUrl' => '/site/themes',
        ),
        'user' => array(
            'allowAutoLogin' => true,
            'loginUrl' => array('/login'),
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                '404/' => 'content/404',
                '<_a:(login|logout)>' => 'avtorization/<_a>',
                'management/<module:\w+>/<controller:\w+>/<action:\w+>/*' => '<module>/<controller>/<action>',
                'management/<module:\w+>/<controller:\w+>*' => '<module>/<controller>',
                'management/<m:>*' => '<m>',
                array("class" => "application.components.redefined.CMyUrlRulez",),
            ),
        ),
        "cache" => array(
            "class" => "application.components.redefined.CMyFileCache",
        ),
    ),
    'params' => array(
        'mainTitle' => "",
        'mainTheme' => "default",
        'adminTheme' => "rubicsms",
        'mainAdminpage' => "/management/contentmanager/content",
        'adminEmail' => 'webmaster@example.com',
        'superUser' => array("login" => "SU", "password" => 13),
    ),
);
?>
