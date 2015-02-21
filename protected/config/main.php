<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Budget',
  'defaultController' => 'main',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'asdfasdf',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),*/
		
	),

	// application components
	'components'=>array(
    'curl' => array(
        'class' => 'ext.curl.Curl',
        'options' => array(/* additional curl options */),
    ),
  
    'clientScript' => array(
          'scriptMap' => array(
              'jquery.js' => 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', // set your path here
          ),
      ),
		/*'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),*/
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
      'showScriptName'=>false,
      'caseSensitive'=>false,  
			'rules'=>array(
        '/'=>'main/main',
				'<controller:\w+>/<id:\d+>'=>'<controller>/main',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=xxxxxxxxxxxx',
			'emulatePrepare' => true,
			'username' => 'xxxxxxxxxx',
			'password' => 'xxxxxxxxxx',
			'charset' => 'utf8',
		),
    
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'main/error',
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
    //API key for League of Legends  
    'API_KEY'=>'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx',
		// this is used in contact page
		'adminEmail'=>'jj@j2.io',
	),
);
