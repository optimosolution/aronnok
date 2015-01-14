<?php

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Aronnok Holiday Resort',
    'sourceLanguage' => 'en_us',
    'language' => 'en',
    // preloading 'log' component
    'preload' => array('log'),
    //Default time zone
    'timeZone' => 'Asia/Dhaka',
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    // application components
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=rangamat_resort',
            'emulatePrepare' => true,
            'username' => 'rangamat_resort',
            'password' => 'X.o.DF&M5*Zm',
            'charset' => 'utf8',
            'tablePrefix' => 'os_'
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminName' => 'Aronnok Holiday Resort',
        'adminEmail' => 'info@rangamatiresort.com',
        'bookingEmail' => 'booking@rangamatiresort.com',
        'contactEmail' => 'contact@rangamatiresort.com',
        'pageSize' => 10,
        'pageSize20' => 20,
    ),
);
