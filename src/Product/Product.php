<?php


namespace Quanpan302\Wxrrd\Product;


use Carbon\Carbon;
use Quanpan302\Wxrrd\Api;

class Product extends Api
{

    const QUERY_API            = '/router/rest';
    const QUERY_METHOD_LISTS   = 'weiba.wxrrd.goods.lists';
    const QUERY_METHOD_DETAILS = 'weiba.wxrrd.goods.details';
    
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
        $params['method']       = self::QUERY_METHOD_LISTS;
        $params['timestamp']    = Carbon::now()->toDateTimeString();
        $params['format']       = 'json';
        // passed from Controller $params
        $params['appid']        = $this->appId;
        $params['secret']       = $this->appKey;
        // options
        // sign
        ksort($params);
        $params['sign'] = strtoupper(md5($this->url_build_query($params)));

        return $this->request($requestMethod, self::QUERY_API, $params);
    }

}

