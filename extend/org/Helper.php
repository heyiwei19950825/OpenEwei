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

}