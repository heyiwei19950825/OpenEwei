<?php
/**----------------------------------------------------------------------
 * EweiAdmin V1
 * Copyright 2018-2018 http://www.redkylin.con All rights reserved.
 * ----------------------------------------------------------------------
 * Author: ewei(lamp_heyiwei@163.com)
 * Date: 2018/12/18
 * Time: 11:08
 * ----------------------------------------------------------------------
 */

namespace org;


class Helper
{
    /**
     * @param $code
     * @param string $data
     * @param int $count
     * @param bool $sign
     * @param bool $isexit
     * @return array
     */
    static function json_error($code, $data='',$count=0, $sign=false, $isexit=true){
        if(empty($data)){
            $data = array('msg'=>config('ERR_CODE.'.$code));
        }

        $return = array();
        $return['code'] = $code;
        $return['result'] = 'error';
        $return['time'] = time();
        if (is_array($data) && count($data) == 0){
            $return['data'] = null;
        } else {
            $return['data'] = $data;
        }

        if($sign && is_array($data)){
            $return['sign'] = create_s($data);
        }

        if($isexit){
            header('Content-Type:application/json; charset='.config('DEFAULT_CHARSET'));
            echo json_encode($return);
            exit;
        }else{
            return $return;
        }
    }

    /**
     * @param array $data
     * @param int $count
     * @param bool $signasdasdasd
     * @param bool $isexit
     * @return array
     */
    static function json_success($data=[],$count=0, $sign=false, $isexit=true){
        $return = array();
        $return['code'] = 0;
        $return['time'] = time();
        if (is_array($data) && count($data) == 0) {
            $return['data'] = null;
        }else{
            $return['data'] = $data;
        }
        if( $count !== false){
            $return['count'] = $count;
        }
        if($sign && is_array($data)){
            $return['sign'] = create_sign($data);
        }

        if($isexit){
            header('Content-Type:application/json; charset='.config('DEFAULT_CHARSET'));
            echo json_encode($return);
            exit;
        }else{
            return $return;
        }
    }

    /**
     * 数据排序、删除杂项及空值
     */
    function para_filter_sort($para) {
        $para_filter = array();
        ksort($para);

        foreach ($para as $key=>$val) {
            //将key全部小写
            $key = strtolower($key);
            if ($key === "sign" || $key === "action" || $key === "_request" || $val === "" || is_null($val)) {
                continue;
            } else {
                if (is_bool($val)) {
                    $para_filter[$key] = (int)$val;
                } else {
                    $para_filter[$key] = is_array($val) ? para_filter_sort($val) : $val;
                }
            }
        }

        return $para_filter;
    }

    /**
     * 生成拼接串
     * @param string $para
     * @return string
     */
    function create_link_string($para){
        $arg = '';
        foreach($para as $key => $val){
            if(is_array($val)){
                $arg .= $key . '=(' . (is_array($val) ? create_link_string($val) : $val) . ')&';
            }else{
                $arg .= $key . '=' . $val . '&';
            }
        }

        if(count($arg) > 0){
            //去掉最后一个&字符
            $arg = substr($arg, 0, count($arg) - 2);
        }

        return $arg;
    }

    /**
     * 生成校验字符串
     * @param string $data
     * @return string
     */
    function create_sign($data){
        $arg = '';
        if($data){
            // 按照key对数组进行排
            $data = para_filter_sort($data);
            // 生成拼接串
            $prestr = create_link_string($data);

            //如果存在转义字符，那么去掉转义
            if(get_magic_quotes_gpc()){
                $arg = stripslashes($arg);
            }

            if(empty($prestr)){
                return '';
            }else{
                $prestr .= C('API_KEY');
                return md5($prestr);
            }
        }else{
            return '';
        }
    }



    /**
     * url参数转化成数组
     * @param string
     * @return mixed
     */
    static function convertUrlArray($query)
    {
        $queryParts = explode('&', $query);
        $params = array();
        foreach ($queryParts as $param) {
            $item = explode('=', $param);
            $params[$item[0]] = $item[1];
        }
        return $params;
    }

    /**
     * 中文url 将url中的中文转换成urlcode编码
     */
    static function chineseUrlToUrlCode($url){
        $urlArr = explode('/',$url);
        $newUrl = '';
        foreach ($urlArr as $k => $v){
            if(preg_match("/[\x7f-\xff]/",$v)){
               $v = urlencode($v);
            }

            $newUrl .= $v.'/';
        }

        return rtrim($newUrl,'/');
    }


    static function iunserializer($value) {
        if (empty($value)) {
            return array();
        }
        if (!is_serialized($value)) {
            return $value;
        }
        $result = unserialize($value);
        if ($result === false) {
            $temp = preg_replace_callback('!s:(\d+):"(.*?)";!s', function ($matchs){
                return 's:'.strlen($matchs[2]).':"'.$matchs[2].'";';
            }, $value);
            return unserialize($temp);
        } else {
            return $result;
        }
    }

    /**
     * 计算经纬度距离
     * @param $lat1
     * @param $lng1
     * @param $lat2
     * @param $lng2
     * @param bool $miles
     * @return float|int
     */

    static function distance($lat1, $lng1, $lat2, $lng2, $miles = true)
    {
        $pi80 = M_PI / 180;
        $lat1 = $pi80;
        $lng1 = $pi80;
        $lat2 = $pi80;
        $lng2 = $pi80;


        $r = 6372.797; // mean radius of Earth in km
        $dlat = $lat2 - $lat1;
        $dlng = $lng2 - $lng1;
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $km = $r * $c;

        return ($miles ? ($km * 0.621371192) : $km);


    }

    /**
     * 时间换算 成 多少天 多少秒
     * @param $secs
     * @return string
     */
    static function secsToStr($time) {
        if( is_string($time) ){
            $time = strtotime($time);
        }
        // 当天最大时间
        $todayLast = strtotime(date('Y-m-d 23:59:59'));
        $agoTimeTrue = time() - $time;
        $agoTime = $todayLast - $time;
        $agoDay = floor($agoTime / 86400);

        if ($agoTimeTrue < 60) {
            $result = '刚刚';
        } elseif ($agoTimeTrue < 3600) {
            $result = (ceil($agoTimeTrue / 60)) . '分钟前';
        } elseif ($agoTimeTrue < 3600 * 12) {
            $result = (ceil($agoTimeTrue / 3600)) . '小时前';
        } else {
            $format = date('Y') != date('Y', $time) ? "Y-m-d" : "m-d";
            $result = date($format, $time);
        }
        return $result;
    }

    /**
     * 模拟GET请求
     */
    static function getCurl($url,$data = null){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //执行
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    /**
     * 模拟POST请求
     */
    static function postCurl( $url,$params ) {
        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 1);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        //设置post数据
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        //显示获得的数据
        return $data;
    }

    /**
     * 生成订单号
     */
    static function createOrderNumber(){
        //生成24位唯一订单号码，格式：YYYY-MMDD-HHII-SS-NNNN,NNNN-CC，
        //其中：YYYY=年份，MM=月份，DD=日期，HH=24格式小时，II=分，SS=秒，NNNNNNNN=随机数，CC=检查码

        @date_default_timezone_set("PRC");
        //订购日期
        $order_date = date('Y-m-d');
        //订单号码主体（YYYYMMDDHHIISSNNNNNNNN）
        $order_id_main = date('YmdHis') . rand(10000000,99999999);
        //订单号码主体长度
        $order_id_len = strlen($order_id_main);
        $order_id_sum = 0;
        for($i=0; $i<$order_id_len; $i++){
            $order_id_sum += (int)(substr($order_id_main,$i,1));
        }
        //唯一订单号码（YYYYMMDDHHIISSNNNNNNNNCC）
        $orderNumber = $order_id_main . str_pad((100 - $order_id_sum % 100) % 100,2,'0',STR_PAD_LEFT);

        return $orderNumber;
    }

}

