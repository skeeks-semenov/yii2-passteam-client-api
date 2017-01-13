Passteam yii2 client api
===================================

Info
------------
* http://wiki.cardsmile.ru:8090/display/PAS/API

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

add to composer.json
```
"repositories": [
    {
        "type": "git",
        "url":  "https://github.com/skeeks-semenov/yii2-passteam-client-api.git"
    }
],
```

Either run

```
php composer.phar require --prefer-dist passteam/yii2-client-api "*"
```

or add

```
"passteam/yii2-client-api": "*"
```

How to use
----------

```php
//App config
[
    'components'    =>
    [
    //....
        'passteamApi' =>
        [
            'class'             => 'passteam\client\api\Api',

            'timeout'           => 12,
            'auth => [
                //'nickname' => '',
                //'password' => '',

                //or

                //'accessToken' => ''
            ]
        ],
    //....
    ]
]

```

Examples
----------

```php

$response = \Yii::$app->v3projectApi->send('/gettemplates', []);

$response = \Yii::$app->v3projectApi->send('/getcards', [
    'templateId' => 'TEMPLATE_ID'
]);

```
___

> [![skeeks!](https://gravatar.com/userimage/74431132/13d04d83218593564422770b616e5622.jpg)](http://skeeks.com)  
<i>SkeekS CMS (Yii2) — fast, simple, effective!</i>  
[skeeks.com](http://skeeks.com) | [cms.skeeks.com](http://cms.skeeks.com) | [marketplace.cms.skeeks.com](http://marketplace.cms.skeeks.com)

