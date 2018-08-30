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
        $requestMethod = "get";

        // constants
        $params['startTime']    = $params['startTime'] ?? Carbon::yesterday()->toDateTimeString();
        $params['endTime']      = $params['endTime'] ?? Carbon::yesterday()->endOfDay()->toDateTimeString();
        // passed from Controller init
        // passed from Controller $params
        // options
        // sign
        // $params['sign'] = strtolower(md5(http_build_query(ksort($params))));

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

