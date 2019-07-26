<?php
/**----------------------------------------------------------------------
 * EweiAdmin V1
 * Copyright 2018-2018 http://www.redkylin.con All rights reserved.
 * ----------------------------------------------------------------------
 * Author: ewei(lamp_heyiwei@163.com)
 * Date: 2019/3/27
 * Time: 13:51
 * ----------------------------------------------------------------------
 */


namespace app\admin\lib;

use think\Exception;

class CollectLib
{

    /**
     * 请求数据处理
     * @param array $params  请求参数
     * @return array
     */
    public function disposeParams( $params = [] ){
        //初始化变量
        $url = $dow_img = $code = $need_login = $login_url = $login_name = $login_password = $table_name = $get_model = $page = $start_page = $make = '';
        $list_name = $list_rule = $list_type = $list_desc = $table_collect_name = $table_field_name =  $second_filtration = $second = $row = $list_filtration = $urlArrKey = $range = [];
        extract($params);
        //普通模式
        if( $get_model ===  "0" ){
            $ruleParams = [];
            //需要做数据转换
            foreach ($list_name as $k => $v){
                foreach( $v as $sK => $sV){
                    //验证规则条是否完整
                    if( empty( $sV ) || empty( $list_rule[$k][$sK] )  || empty( $list_type[$k][$sK] ) || empty( $list_desc[$k][$sK] ) ){
                        return [
                            'msg'       => '列表规则参数不能为空',
                            'result'    => false
                        ];
                    }
                    //规则赋值
                    $ruleParams[$k][$sV] = [$list_rule[$k][$sK],$list_type[$k][$sK],$list_desc[$k][$sK]];
                }
            }
        }else{
            //数据验证
            try{
                $ruleParams = json_decode($params['rule'],true);
            }catch (Exception $e){

                return [
                    'msg'       => '规则格式错误',
                    'result'    => false
                ];
            }
        }

        $rule = array(
            'url'           => $url,            //爬取开始页url
            'page'          => $page,           //爬取页数
            'start_page'    => $start_page,     //爬取开始页
            'range'         => $range,          //爬取规则切片
            'rule'          => $ruleParams,     //爬取规则参数
            'make'          => $make,           //二级抓取标示
        );


        //返回数据
        if(empty($rule)){
            return [
                'msg'       => '列表规则参数不能为空或错误',
                'result'    => false
            ];
        }else{
            return $rule;
        }
    }
}