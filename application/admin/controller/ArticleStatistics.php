<?php
/**----------------------------------------------------------------------
 * 文章统计管理
 * EweiOpen V3
 * Copyright 2017-2018 http://www.redkylin.con All rights reserved.
 * ----------------------------------------------------------------------
 * Author: ewei(lamp_heyiwei@163.com)
 * Date: 2018/11/18
 * Time: 14:38
 * ----------------------------------------------------------------------
 */
namespace app\admin\controller;

use app\admin\model\AdminLog;
use app\common\common\helper;

/**
 * 文章统计管理
 * Class Article
 * @package app\admin\controller
 */
class ArticleStatistics extends Base
{
    protected $url = [];
    public function initialize()
    {
        $this->distData();
        $this->url = config()['api']['user'];
    }

    /**
     * 管理
     * @return mixed
     */
    public function index()
    {
        if ($this->request->isAjax()) {
            $map = [
                'token'     => 'caea90167af2875c9243774ff0ef6150',
                'pageindex' => input('get.page/d', 1),
                'pagesize'  => input('get.limit/d', 10)
            ];
            if($this->request->get('time-scope')){
                $time = $this->request->get('time-scope');
                $time = explode(' - ',$time);
                $map['sarttime']    = $time[0];
                $map['endtime']     = $time[1];
            }

            $map['keyword'] = $this->request->get('keyword', '');
            $map['mobile']  = $this->request->get('mobile', '');
            $map['sex']     = $this->request->get('sex', '');
            $map['status']  = $this->request->get('status', '');
//            $row = helper::http_curl($this->url['list'], $map);

            $row = [
                'result' => 'true',
                'count_info'    =>[
                    'count' =>100
                ],
                'data'=> [
                    ['id' => '1',
                        'article_title' => '好文章',
                        'article_type' => '文章类型',
                        'article_des' => '描述',
                        'article_keywords' => '关键字',
                        'article_hits'=>'21',
                        'article_comments'=>'32',
                        'article_phase'=>'32',
                        'article_status'=>'正常',
                        'article_remake'=>'咋的啦',
                        ]
                ]
            ];
            $list = $count = [];

            if ($row['result']) {
                $list   = $row['data'];
                $count  = $row['count_info']['count'];
            }
            $data = [
                'code'  => 0,
                'msg'   => '数据返回成功',
                'count' => $count,
                'data'  => $list
            ];

            AdminLog::setTitle('获取广告列表');
            return json($data);
        }else{
            return $this->fetch();
        }
    }
}