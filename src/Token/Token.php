<?php


namespace Quanpan302\Wxrrd\Token;


use Quanpan302\Wxrrd\Api;

class Token extends Api
{

    const QUERY_TOKEN_API = '/token';

    /**
     * 分页查询全部商品信息
     *
     * @param array $params
     * @return array
     */
    public function paginate($params = [])
    {
        $requestMethod = "get";

        // constants
        $params['grant_type']   = 'authorization_code';
        // passed from Controller init
        $params['appid']        = $this->appId;
        $params['secret']       = $this->appKey;
        // passed from Controller $params
        // $params['code']         = '';
        // $params['redirect_uri'] = '';
        // options
        $params['refresh_token']= '';
        $params['format']       = '';
        $params['state']        = '';
        // sign
        // ksort($params);
        // $params['sign'] = strtoupper(md5(http_build_query($params)));
        
        // var_dump($params);
        return $this->request($requestMethod, self::QUERY_TOKEN_API, $params);
    }

}

