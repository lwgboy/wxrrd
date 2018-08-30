<?php


namespace Quanpan302\Wxrrd\Token;


use Quanpan302\Pospal\Api;

class Token extends Api
{

    const QUERY_TOKEN_API = '/pospal-api2/openapi/v1/productOpenApi/queryProductPages';

    /**
     * 分页查询全部商品信息
     *
     * @param array $params
     * @return array
     */
    public function paginate($params = [])
    {
        return $this->request(self::QUERY_TOKEN_API, $params);
    }

}

