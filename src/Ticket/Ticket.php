<?php


namespace Quanpan302\Wxrrd\Ticket;


use Carbon\Carbon;
use Quanpan302\Wxrrd\Api;

class Ticket extends Api
{

    const QUERY_TICKET_API = '/router/rest';
    const QUERY_METHOD_LISTS   = 'weiba.wxrrd.trade.lists';
    const QUERY_METHOD_DETAILS = 'weiba.wxrrd.trade.details';
    
    const QUERY_ALL_PAY_METHOD_API = '/pospal-api2/openapi/v1/ticketOpenApi/queryAllPayMethod';
    const QUERY_TICKET_BY_SN_API = '/pospal-api2/openapi/v1/ticketOpenApi/queryTicketBySn';
    const QUERY_TICKET_PAGES_API = '/pospal-api2/openapi/v1/ticketOpenApi/queryTicketPages';
    
    /**
     * 根据单据序列号查询
     *
     * @param $sn
     * @return array
     */
    public function query($sn)
    {
        $requestMethod = "get";

        // passed from Controller init
        // passed from Controller $params
        // options
        // sign
        // $params['sign'] = strtolower(md5(http_build_query(ksort($params))));

        return $this->request($requestMethod, self::QUERY_TICKET_BY_SN_API, ['sn' => $sn]);
    }

    /**
     * 分页查询所有单据
     *
     * @param $params
     * @return array
     * @throws \Quanpan302\Wxrrd\HttpException
     */
    public function paginate($params = [])
    {
        access_token:71da7fb0579d69a10454954da2ec1603
        appid:5755a21690a3cd0a
        created_at_end:2018-08-28 23:59:59
        created_at_start:2018-08-28 00:00:00
        format:json
        method:weiba.wxrrd.trade.lists
        timestamp:2018-08-28 17:30:00
        type:all
        sign:CBA1F05DDE2514CB82733BB0EFF57165

        $requestMethod = "get";

        // constants
        $params['method']       = self::QUERY_METHOD_LISTS;
        $params['timestamp']    = Carbon::now()->toDateTimeString();
        $params['format']       = 'json';
        $params['type']         = 'all';
        $params['created_at_start'] = $params['startTime'] ?? Carbon::yesterday()->toDateTimeString();
        $params['created_at_end']   = $params['endTime'] ?? Carbon::yesterday()->endOfDay()->toDateTimeString();
        // passed from Controller init
        $params['appid']        = $this->appId;
        // passed from Controller $params
        // options
        // sign
        $params['sign'] = strtolower(md5(http_build_query(ksort($params))));

        return $this->request($requestMethod, self::QUERY_TICKET_API, $params);
    }

    /**
     * 获取全部订单
     *
     * @param array $params
     * @param \Closure $callback
     * @return void
     * @throws \Quanpan302\Pospal\HttpException
     */
    public function all($params = [], \Closure $callback)
    {
        $params['postBackParameter'] = null;

        while (true) {
            $tickets = $this->paginate($params);

            $callback($tickets['data']['result']);

            if ($tickets['status'] === 'success' && count($tickets['data']['result']) === $tickets['data']['pageSize']) {

                $params['postBackParameter'] = ($tickets['data']['postBackParameter']);

            } else {
                return;
            }
        }
    }

}

