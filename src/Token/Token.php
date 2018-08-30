<?php


namespace Quanpan302\Wxrrd\Token;


use Quanpan302\Pospal\Api;

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
        // appid:5755a21690a3cd0a
        // secret:770195755a21690a3cd0a1e7ebac4064
        // grant_type:authorization_code
        // refresh_token:
        // code:6fe3bfcbeab29793
        // redirect_uri:http://www.ferraribabyhouse.com/wxrrd/
        // format:
        // state:
        $requestMethod = "get";
        
        $params = array(
            'grant_type' => 'authorization_code',
            'refresh_token' => '',
        );
        return $this->request($requestMethod, self::QUERY_TOKEN_API, $params);
    }

}

