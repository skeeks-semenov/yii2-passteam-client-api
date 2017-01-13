<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 15.09.2016
 */
namespace v3toys\v3project\api;
/**
 * Class ApiV5
 *
 * @package v3toys\v3project\api
 */
class ApiV1 extends ApiBase
{
    const VERSION = 'v1';

    /**
     * Получение информации о товарах
     * 
     * @param array $params 
     * exemple:
     * [
            'filters' =>
            [
                'v3p_product_ids' => [186893]
            ],
            'params' =>
            [
                'format' => 'without_features'
            ]
        ]
     *
     * @return helpers\ApiResponse
     */
    public function productFind($params = [])
    {
        return $this->send('/product/find', $params);
    }
}