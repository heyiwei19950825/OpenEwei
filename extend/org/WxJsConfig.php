<?php
/**----------------------------------------------------------------------
 * EweiAdmin V1
 * Copyright 2018-2018 http://www.redkylin.con All rights reserved.
 * ----------------------------------------------------------------------
 * Author: ewei(lamp_heyiwei@163.com)
 * Date: 2019/1/9
 * Time: 11:07
 * ----------------------------------------------------------------------
 */
namespace org;

class WxJsConfig
{
    static  $count=5;    //用于控制重复调用微信接口的次数，确保一定能调取成功
    private $wxAppId;  //公众号的appid
    private $wxAppSecret; //公众号的app_secret

    public function __construct()
    {
        $this->wxAppId      = 'wx34c7a253ee8bb252';
        $this->wxAppSecret  = '4d5e20de795b2e477754bad89482f43d';
    }

    /** 发送curl请求
     * @param $url
     * @param string $method
     * @param array $requestData
     * @return mixed
     */
    public function curlRequest($url,$method='get',$requestData=[])
    {
        try {
            $curlHandle = curl_init();
            curl_setopt($curlHandle, CURLOPT_URL, $url);
            curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
            if ($method == 'post') {
                curl_setopt($curlHandle, CURLOPT_POST, true);
                curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $requestData);
            }
            $response = curl_exec($curlHandle);
            curl_close($curlHandle);
            return $response;
        } catch (\Exception $e) {
            exit('请求失败:' . $e->getMessage());
        }
    }

    public function getJsConfig()
    {
        try{
            //此URL是需要调用微信JS-SDK页面的url，由前端页面传过来的且包含请求参数部分
            $url = $_GET['url'];
            if(!$url){
                exit('缺少必要参数');
            }

            $acc_url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='
                .$this->wxAppId .'&secret='.$this->wxAppSecret;
            $acc_url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx34c7a253ee8bb252&secret=4d5e20de795b2e477754bad89482f43d';

            //TODO  实际开发中获取access_token要进行缓存，执行curlRequest前判断是否存在缓存，不存在才进行调用，建议缓存7200秒
            $accToken = json_decode($this->curlRequest($acc_url),true) ;
            if(!isset($accToken['access_token'])){
                exit($accToken['errmsg']);
            }
            $accToken = $accToken['access_token'];
            $ticket_url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$accToken.'&type=jsapi';
            $ticket = json_decode($this->curlRequest($ticket_url),true);
            if(!isset($ticket['ticket'])){
                return exit('微信服务器异常');
            }
            $ticket = $ticket['ticket'];
            //生成随机字符串
            $randStr   = '';
            $str       = $ticket.$accToken;
            $strLength = strlen($str);
            for ($i=0;$i<15;$i++){
                if($i%3==0){
                    $randStr.=rand();
                }
                $randStr.=$str[rand(0,$strLength)];
            }
            $randStr.=rand();
            $time = time();
            $tempSort = [
                'noncestr'=>$randStr,
                'jsapi_ticket'=>$ticket,
                'timestamp'=>$time,
                'url'=>$url
            ];
            $keyStr = array_flip($tempSort);
            //加密参数是按参数名排序，不是按值排序
            ksort($tempSort,SORT_STRING);
            $params = $tempSort;
            $shaString = '';
            foreach ($params as $key=>$val){
                if($shaString==''){
                    $shaString = $keyStr[$val].'='.$val;
                }else{
                    $shaString.='&'.$keyStr[$val].'='.$val;
                }
            }
            $signature = sha1($shaString);
            $jsConfig = [
                'appId'=>$this->wxAppId,
                'timestamp'=>$time,
                'nonceStr'=>$randStr,
                'signature'=>$signature,
                //此处填写你需要调用的JS列表，比如这里是调用的微信获取地理位置
                'jsApiList'=>['checkJsApi', 'openLocation','getLocation'],
                'test'=>[
                    'ticket'=>$ticket,
                    'url'=>$url
                ]
            ];
            return json_encode($jsConfig,true);
        }catch (\Exception $e){
            if(self::$count>0){     //重复调用，尽量请求成功
                self::$count-=1;
                $this->getJsConfig();
            }else{
                exit('微信服务器异常');
            }
        }

    }

}
