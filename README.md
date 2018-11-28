Yii2 DB Config Manager
======================
Yii2 DB Config Manager.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist bz4work/yii2-db-config-manager "*"
```

or add

```
"bz4work/yii2-db-config-manager": "*"
```

to the require section of your `composer.json` file.


Добавить в ваш корневой composer.json, в секцию 'repositories':

    {
        "type": "git",
        "url": "https://github.com/bz4work/yii2-db-config-manager.git"
    }
    
    
Добавить в config.php:

    'adminconf' => [
        'class' => 'wk\Module',
    ],

Usage:
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \bz4work\AutoloadExample::widget(); ?>
```

Добавить роут в config.php:

    '/adminconf' => 'adminconf/default/index'
    
Перейти в браузере:
    
    http://yourdomain.com/adminconf/
    
Настроить права доступа к модулю если требуется.

