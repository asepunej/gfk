<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
//date_default_timezone_set('Asia/Calcutta');
//

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
   	'name'=>'Sistem Informasi Pengadaan Barang dan Jasa',
        'theme'=>'AdminLTE',
        'timeZone' => 'Asia/Jakarta',

	// preloading 'log' component
        'preload' => array(
        'less',
       // 'bootstrap',
        'log',
    ),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.extensions.yiichat.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'samkok',
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

//        'bootstrap' => array(
//            'class' => 'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
//            'coreCss' => false,
//            'yiiCss' => false,
//            'responsiveCss' => false,
//        ),
		// uncomment the following to enable URLs in path-format

//		'urlManager'=>array(
//		    'caseSensitive'=>false,
//			'urlFormat'=>'simangga',
//            'showScriptName'=>false,
//			'rules'=>array(
//                '<action>'=>'site/<action>',
//				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
//				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
//				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
//			),
//		),

		/*
        'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database


//        'db'=>array(
//            'connectionString' => 'pgsql:host=7.27.93.127;dbname='.$db,
//            'username' => 'admin',
//            'password' => 'admin!',
//            //'charset' => 'utf8',
//            'class'            => 'CDbConnection'
//        ),

       

		// 'db'=>array(
        //     'connectionString' => 'pgsql:host=10.10.3.113;port=5434;dbname=simkeu_0627',
		// 	'emulatePrepare' => true,
        //     'username' => 'simkeu',
        //     'password' => 'SimkeuUN#J',
        //     'charset' => 'utf8',
		// 	'enableProfiling' =>true,
		// 	'enableParamLogging' => true,
        //     'class' => 'CDbConnection'
        // ),

		



       'db'=>array(
           'connectionString' => 'pgsql:host=localhost;dbname=simrs',
           'username' => 'postgres',
           'password' => 'as10se76',
           //'charset' => 'utf8',
           'class'            => 'CDbConnection'
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
        'appkey' => 'RFVtTTlaS0pkT3lmbnk3djNaZEo4WEszYUtKN3hSaEU=',
		'adminEmail'=>'webmaster@example.com',
	),
);



