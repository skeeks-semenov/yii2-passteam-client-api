<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 15.09.2016
 */
namespace passteam\client\api;

use skeeks\cms\helpers\StringHelper;
use v3toys\v3project\api\helpers\ApiResponse;
use v3toys\v3project\api\helpers\ApiResponseError;
use v3toys\v3project\api\helpers\ApiResponseOk;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\httpclient\Client;

/**
 * @property string $version    read-only
 * @property string $baseUrl    read-only
 *
 * @property string $accessToken    read-only
 *
 * @see http://wiki.cardsmile.ru:8090/display/PAS/API - docs
 *
 * Class ApiBase
 *
 * @package passteam\client\api
 */
abstract class ApiBase extends Component
{
    /**
     * версия api, на настоящий момент v5
     */
    const VERSION = 'v1';

    /**
     * @var string
     */
    public $schema = 'https://';

    /**
     * @var string
     */
    public $host = 'testing.getpass.test.walletpass.ru';

    /**
     * Данные для авторизации в апи
     * @var array
     */
    public $auth =
    [
        //'nickname' => '',
        //'password' => '',

        //or

        //'accessToken' => ''
    ];

    /**
     * @var int set timeout to 15 seconds for the case server is not responding
     */
    public $timeout = 30;

    /**
     * @var bool
     */
    public $isDev = false;

    /**
     * Коды ответа на запрос
     *
     * @var array
     */
    static public $errorStatuses = [
        '404'   =>  'Запрошенный метод апи не существует',
        '500'   =>  'Произошла внутренняя ошибка сервиса во время обработки',
    ];



    /**
     * @param $method           вызываемый метод, список приведен далее
     * @param array $params     параметры соответствующие методу запроса
     *
     * @return ApiResponse
     */
    public function send($apiMethod, array $params = [])
    {
        $apiUrl = $this->baseUrl . $apiMethod;

        $client = new Client([
            'requestConfig' => [
                'format' => Client::FORMAT_JSON
            ]
        ]);

        $httpRequest = $client->createRequest()
                            ->setMethod("POST")
                            ->setUrl($apiUrl)
                            ->addHeaders(['Content-type' => 'application/json'])
                            ->addHeaders(['user-agent' => 'JSON-RPC PHP Client'])
                            ->setData($params)
                            ->setOptions([
                                'timeout' => $this->timeout
                            ]);

        $httpResponse       = $httpRequest->send();

        $apiResponse = new ApiResponse([
            'api'                   => $this,
            'httpClientRequest'     => $httpRequest,
            'httpClientResponse'    => $httpResponse,
            'apiMethod'             => $apiMethod,
        ]);

        return $apiResponse;
    }

    protected $_accessToken = null;

    /**
     * @return false|null|string
     */
    public function getAccessToken()
    {
        if ($this->_accessToken !== null)
        {
            return $this->_accessToken;
        }

        if ($this->_accessToken = ArrayHelper::getValue($this->auth, 'accessToken', false))
        {
            return $this->_accessToken;
        }

        //TODO::add auth by nicname and password;
        return '';
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return static::VERSION;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        if ($this->isDev)
        {
            return $this->schema . $this->host . "/oapi/" . $this->version;
        } else
        {
            return $this->schema . $this->host . "/oapi/" . $this->version;
        }

    }


    /**
     * @param $httpStatusCode
     *
     * @return string
     */
    public function getMessageByStatusCode($httpStatusCode)
    {
        return (string) ArrayHelper::getValue(static::$errorStatuses, (string) $httpStatusCode);
    }
}