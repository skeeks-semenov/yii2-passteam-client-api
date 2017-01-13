<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 15.09.2016
 */
namespace passteam\client\api;
/**
 * Class ApiV1
 *
 * @package passteam\client\api
 */
class ApiV1 extends ApiBase
{
    const VERSION = 'v1';

    /**
     * Информация о Шаблонах
     *
     * Получение подробной информации о всех доступных Шаблонах для пользователя.
     *
     * @see http://wiki.cardsmile.ru:8090/pages/viewpage.action?pageId=9469992;
     * @return helpers\ApiResponse
     */
    public function getTemplates($request = [])
    {
        //$request = ['passTypeId' => '']
        return $this->send('/gettemplates', $request);
    }

    /**
     * Информация об Электронных картах
     *
     * Используется для получения информации о всех Электронных картах, созданных по определенному Шаблона
     *
     * @see http://wiki.cardsmile.ru:8090/pages/viewpage.action?pageId=9470005
     * @return helpers\ApiResponse
     */
    public function getCards($request = ['templateId' => ''])
    {
        return $this->send('/getcards', $request);
    }

    /**
     * Информация об Электронной карте
     *
     * Используется для получения подробной информации об Электронной карте.
     *
     * @see http://wiki.cardsmile.ru:8090/pages/viewpage.action?pageId=9470005
     * @return helpers\ApiResponse
     */
    public function getCard($cardId)
    {
        return $this->send('/getcard', [
            'cardId' => $cardId
        ]);
    }
}