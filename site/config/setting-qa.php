<?php 
 return Array( 
        "basePath" => $_SERVER["DOCUMENT_ROOT"]."/protected/config/..", 
	"runtimePath" => $_SERVER["DOCUMENT_ROOT"]."/site/runtime", 
	"theme" => "rubicsms", 
            'preload' => array('log'),
	"import" =>array( 
		"0" => "application.components.redefined.*", 
		"1" => "application.components.controller.*", 
		"2" => "application.components.based.*", 
		"3" => "application.extensions.*", 
		"4" => "application.models.*", 
		"5" => "application.modules.contentmanager.models.*", 
		"6" => "application.modules.modulemanager.models.*", 
	), 
	"modules" =>array( 
		"0" => "blockmanager", 
		"1" => "catalogmanager", 
		"2" => "contentmanager", 
		"3" => "feedsmanager", 
		"4" => "translatemanager", 
		"5" => "modulemanager", 
		"6" => "seomanager", 
		"7" => "usermanager", 
	), 
	"components" =>array( 
             "assetManager" => array(
            "basePath" => $_SERVER["DOCUMENT_ROOT"] . "/site/assets",
            "baseUrl" => "/site/assets",
        ),
        "themeManager" => array(
            "basePath" => $_SERVER["DOCUMENT_ROOT"] . "/site/themes",
            "baseUrl" => "/site/themes",
        ),
		"user" =>array( 
			"allowAutoLogin" => "1", 
			"loginUrl" =>array( 
				"0" => "/login", 
			), 
		), 
		"urlManager" =>array( 
			"urlFormat" => "path", 
			"showScriptName" => "", 
			"rules" =>array( 
                                            "db/" => "content/test",
				"404/" => "content/404", 
				"<_a:(login|logout)>" => "avtorization/<_a>", 
				"management/<module:\w+>/<controller:\w+>/<action:\w+>/*" => "<module>/<controller>/<action>", 
				"management/<module:\w+>/<controller:\w+>*" => "<module>/<controller>", 
				"management/<m:>*" => "<m>", 
				"0" =>array( 
					"class" => "application.components.redefined.CMyUrlRulez", 
				), 
			), 
		), 
		"cache" =>array( 
			"class" => "application.components.redefined.CMyFileCache", 
		), 
		"db" =>array( 
			"class" => "CDbConnection", 
			"connectionString" => "mysql:host=localhost;dbname=qulix_qa_ru", 
			"emulatePrepare" => "1", 
			"username" => "root", 
			"password" => "", 
			"charset" => "utf8", 
			"schemaCacheID" => "cache", 
			"queryCacheID" => "cache", 
			"schemaCachingDuration" => "3600", 
                         'enableProfiling' => true,
                         'enableParamLogging' => true,
		), 
                    'log' => array(
            'class' => 'CLogRouter',
            'enabled' => true,
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                array(
                   'class' => 'application.extensions.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters' => array('127.0.0.1', '192.168.1.215'),
                ),
            ),
        ),
	), 
	"params" =>array( 
		"mainTitle" => "", 
		"mainTheme" => "qa", 
		"adminTheme" => "rubicsms", 
		"mainAdminpage" => "/management/contentmanager/content", 
		"adminEmail" => "webmaster@example.com", 
		"superUser" =>array( 
			"login" => "SU", 
			"password" => "13", 
		), 
	), 
	"language" => "en", 
); 
 ?> 
