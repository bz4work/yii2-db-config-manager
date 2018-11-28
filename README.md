Yii2 DB Config Manager
======================
Yii2 DB Config Manager.

###Requirements:
1. yiisoft/yii2-redis
2. php 7.2.0

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist bz4work/yii2-db-config-manager:dev-master
```

or add

```
"bz4work/yii2-db-config-manager": "@dev"
```

to the require section of your `composer.json` file.

Add to your root composer.json, in the 'repositories' section:

    {
        "type": "git",
        "url": "https://github.com/bz4work/yii2-db-config-manager.git"
    }
    
    
Configure the module in config.php

    'modules' => [
    
        //...other modules
        
        'config-manager' => [
            'class' => 'bz4work\Module'
        ],
    ],

Add index route to config.php:
    
    'rules' => [
        //other rules...
        
        '/config-manager' => 'config-manager/default/index'
     ]
    
Run migrations:
    
    yii migrate --migrationPath=@bz4work/migrations

Configure your Redis Cache server:

    //....
    'components' => [
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
            'password' => 'foobared'
        ],
    ]


Usage:
-----

Once the extension is installed, simply use it in your code by:

1. CRUD Config Manager:


    http://yourdomain.com/config-manager
    or
    http://yourdomain.com/config-manager/default/index

2. Get Param: 
```php
$configManager = \bz4work\ConfigManager::getInstance();
$header1 = $configManager->get('header1');
```

3. Set new Param:

Allowed 3 common type: INT, FLOAT, TEXT.
```php
$configManager = \bz4work\ConfigManager::getInstance();
$configManager->set('param_name', 'some_text_or_value', 'INT');
```

4. Get all parameters:
```php
$configManager = \bz4work\ConfigManager::getInstance();

$configManager->getParams(); //get all as array
$configManager->getParams(false); //get all as list of objects 
```