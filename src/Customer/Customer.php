<?php


namespace Quanpan302\Wxrrd\Customer;


use Carbon\Carbon;
use Quanpan302\Wxrrd\Api;

class Customer extends Api
{

    const QUERY_API            = '/router/rest';
    const QUERY_METHOD_LISTS   = 'weiba.wxrrd.user.lists';
    const QUERY_METHOD_DETAILS = 'weiba.wxrrd.user.details';
    
    const QUERY_BY_NUMBER_API = '/pospal-api2/openapi/v1/customerOpenApi/queryByNumber';
    const QUERY_CUSTOMER_PAGES_API = '/pospal-api2/openapi/v1/customerOpenApi/queryCustomerPages';
    const QUERY_BY_UID_API = '/pospal-api2/openapi/v1/customerOpenApi/queryByUid';

    /**
     * 根据会员号查询会员
     *
     * @param $customerNum
     * @return array
     */
    public function queryByNum($customerNum)
    {
        $requestMethod = "get";
        
        // passed from Controller init
        // passed from Controller $params
        // options
        // sign
        // ksort($params);
        // $params['sign'] = strtoupper(md5(http_build_query($params)));

        return $this->request($requestMethod, self::QUERY_API, $params);
    }

    /**
     * 根据会员在银豹系统的唯一标识查询
     *
     * @param $uid
     * @return array
     */
    public function queryByUid($uid)
    {
        $requestMethod = "get";
        
        // passed from Controller init
        // passed from Controller $params
        // options
        // sign
        // ksort($params);
        // $params['sign'] = strtoupper(md5(http_build_query($params)));

        return $this->request($requestMethod, self::QUERY_API, $params);
    }

    /**
     * 分页查询会员
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
