<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'sourceLanguage'=>'en_us',
	'language'=>'zh_cn',
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		//'ext.YiiMailer.YiiMailer',
		//'ext.LangUrlManager.LangUrlManager',
		'ext.yii-mail.YiiMailMessage',
		
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin888',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		
		'member'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		
		//yii-mail component
		'mail' => array(
                'class' => 'ext.yii-mail.YiiMail',
                'transportType'=>'smtp',
                'transportOptions'=>array(
                        'host'=>'smtp.163.com',
                        'username'=>'hhyfly99@163.com',
                        'password'=>'lang29tian8317',
                        'port'=>'25',     
                ),
                'viewPath' => 'application.views.mail',
        ),
        //yii RBAC component
        'authManager'=>array(
        	'class'=>'CDbAuthManager',
        	'defaultRoles'=>array('guest'),
        	'itemTable'=>'authItem',
        	'itemChildTable'=>'authItemChild',
        	'assignmentTable'=>'authAssignment',
        ),
		/*
		'email'=>array(
			'class'=>'ext.YiiMailer.YiiMailer',
			'Host'=>'smtp.163.com',
			'Port'=>25,
			'CharSet'=>'utf-8',
			'Encoding'=>'base64',
			'SMTPAuth'=>true,
			'Username'=>'hhyfly99@163.com',
			'Password'=>'lang29tian8317',
		),
		*/
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
        	'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
        		
        		//admin controller
        		/*
        		'<AdminIdentity:\w+>/<id:\d+>'=>'<AdminIdentity>/view',
				'<AdminIdentity:\w+>/<action:\w+>/<id:\d+>'=>'<AdminIdentity>/<action>',
				'<AdminIdentity:\w+>/<action:\w+>'=>'<AdminIdentity>/<action>',
				*/
			),
		),
		/*
		'LangUrlManager'=>array(
			'class'=>'application.extensions.LangUrlManager.LangUrlManager',
            'languages'=>array('zh_cn','en_us'),
            'langParam'=>'language',
		),
		*/
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=yondshion',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '123456',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'hhyfly99@163.com',
	),
	
);