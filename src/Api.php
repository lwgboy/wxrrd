<?php


namespace Quanpan302\Wxrrd;


use Quanpan302\Foundation\AbstractAPI;

class Api extends AbstractAPI
{

    protected $appId;

    protected $appKey;

    protected $code;

    protected $url;

    public function __construct($appId, $appKey, $url)
    {
        $this->appId  = $appId;
        $this->appKey = $appKey;
        $this->url    = $url;
    }

    /**
     * 请求接口
     *
     * @param $path
     * @param array $params
     * @return array
     * @throws HttpException
     */
    public function request($requestMethod, $path, $params = [])
    {
        ksort($params);
        
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_HEADER, 0);
        // curl_setopt($curl, CURLOPT_HTTPHEADER, [
        //     "User-Agent: openApi",
        //     "Content-Type: application/json; charset=utf-8",
        //     "accept-encoding: gzip,deflate",
        //     "time-stamp: ".time(),
        //     "data-signature: ".strtoupper(md5($this->appKey.json_encode($params)))
        // ]);

        // Get
        if($requestMethod === "get") {
            // 要访问的地址
            curl_setopt($curl, CURLOPT_URL, $this->url . $path .'?'.http_build_query($params));
            // 对认证证书来源的检查
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            // 获取的信息以文件流的形式返回
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        }
        // Post
        if($requestMethod === "post") {
            // 要访问的地址
            curl_setopt($curl, CURLOPT_URL, $this->url . $path);
            // 对认证证书来源的检查
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            // Post提交的数据包
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
            // 发送一个常规的Post请求
            curl_setopt($curl, CURLOPT_POST, 1);
            // 获取的信息以文件流的形式返回
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        }

        $output = curl_exec($curl);

        if (curl_errno($curl)) {
            throw new HttpException(curl_error($curl));
        }

        curl_close($curl);

        $result = json_decode($output, true);

        $this->checkAndThrow($result);

        return $result;
    }

    /**
     * 检查错误
     *
     * @param $result
     * @throws HttpException
     */
    private function checkAndThrow($result)
    {
        if (array_key_exists('errCode', $result)) {
            if (int($result['errCode']) > 0) {
                throw new HttpException($result['errCode']);
            }
        }
    }

    /**
     * 添加请求 header
     */
    public function middlewares()
    {
    }


}
