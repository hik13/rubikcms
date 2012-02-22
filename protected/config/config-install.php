<?php

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'sourceLanguage' => 'en',
    'language' => 'en',
    'theme' => "rubicsms",
    'import' => array(
        'application.components.redefined.*',
        'application.components.controller.*',
        'application.components.based.*',
        'application.extensions.*',
        'application.models.*',
        'application.modules.contentmanager.models.*',
        'application.modules.modulemanager.models.*',
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
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                '/' => 'install/start',
                '<controller:\w+>/<action:\w+>/*' => '<controller>/<action>',
            ),
        ),
    ),
    
    'params' => array(
        'adminTheme' => "rubicsms",
        'notDB'=>true,
    ),
    
    
);
?>


