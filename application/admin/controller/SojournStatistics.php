<?php
/**----------------------------------------------------------------------
 * 机构统计管理
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
 * 机构统计管理
 * Class Article
 * @package app\admin\controller
 */
class SojournStatistics extends Base
{
    protected $url = [];
    public function initialize()
    {
        $this->url = config()['api']['resthome_statistics'];
    }

    /**
     * 机构招聘管理
     * @return mixed
     */
    public function index()
    {
        if ($this->request->isAjax()) {
            $map = [
                'token'     => 'caea90167af2875c9243774ff0ef6150',
                'pageindex' => input('get.page/d', 1),
                'pagesize'  => input('get.limit/d', 20)
            ];

            $param = $this->request->get();
            $map = array_merge($map,$param);

            $row = helper::http_curl($this->url['list'], $map);
            $list = $count = [];

            if ($row['result']) {
                $list = $row['data'];
                $count = $row['count_info']['count'];
            }

            $data = [
                'code'  => 0,
                'msg'   => '数据返回成功',
                'count' => $count,
                'data'  => $list
            ];

            AdminLog::setTitle('获取机构招聘列表');
            return json($data);
        }else{
            return $this->fetch();
        }
    }
}