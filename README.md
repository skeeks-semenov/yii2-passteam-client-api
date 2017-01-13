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

$response = \Yii::$app->passteamApi->send('/gettemplates', []);

$response = \Yii::$app->passteamApi->send('/getcards', [
    'templateId' => 'TEMPLATE_ID'
]);



print_r($response->httpClientRequest->url);     //Full api url
print_r($response->httpClientRequest->data);    //Request data
print_r($response->httpClientRequest->method);  //Request method
print_r($response->httpClientRequest->headers); //Request headers

print_r($response->httpClientResponse->statusCode); //Server response code
print_r($response->httpClientResponse->content);    //Original api response

if ($response->isError)
{
    print_r($response->errorMessage); //Расшифровка кода
    print_r($response->errorData);
    print_r($response->errorCode);
} else
{
    print_r($response->data); //Array response data
}

```
___

> [![skeeks!](https://gravatar.com/userimage/74431132/13d04d83218593564422770b616e5622.jpg)](http://skeeks.com)  
<i>SkeekS CMS (Yii2) — fast, simple, effective!</i>  
[skeeks.com](http://skeeks.com) | [cms.skeeks.com](http://cms.skeeks.com) | [marketplace.cms.skeeks.com](http://marketplace.cms.skeeks.com)

