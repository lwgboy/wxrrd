<?php


namespace Quanpan302\Wxrrd\Product;


use Quanpan302\Pospal\Api;

class Product extends Api
{

    const QUERY_PRODUCT_API = '/router/rest';
    
    const QUERY_PRODUCT_PAGES_API = '/pospal-api2/openapi/v1/productOpenApi/queryProductPages';

    /**
     * 分页查询全部商品信息
     *
     * @param array $params
     * @return array
     */
    public function paginate($params = [])
    {
        $requestMethod = "get";
        
        return $this->request($requestMethod, self::QUERY_PRODUCT_PAGES_API, $params);
    }

}

