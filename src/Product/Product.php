<?php


namespace Quanpan302\Wxrrd\Product;


use Quanpan302\Wxrrd\Api;

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
        
        // passed from Controller init
        // passed from Controller $params
        // options
        // sign
        // ksort($params);
        // $params['sign'] = strtoupper(md5(http_build_query($params)));

        return $this->request($requestMethod, self::QUERY_PRODUCT_PAGES_API, $params);
    }

}

