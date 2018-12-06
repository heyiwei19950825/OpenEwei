<?php
/**----------------------------------------------------------------------
 * 预约管理
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
 * 预约管理
 * Class Article
 * @package app\admin\controller
 */
class System extends Base
{
    protected $book = [];
    public function initialize()
    {
        $this->book = config()['api']['resthome'];
    }

    /**
     * 预约管理
     * @return mixed
     */
    public function index()
    {
        if ($this->request->isAjax()) {
            $map = [
                'token'     => 'caea90167af2875c9243774ff0ef6150',
                'modeType'  => '1',
                'pageindex' => input('get.page/d', 1),
                'pagesize'  => input('get.limit/d', 20)
            ];

            $map['name'] = $this->request->get('name', '');
            $map['brand_id'] = $this->request->get('brand_id', '');
            $map['nature'] = $this->request->get('nature', '');
            $map['type'] = $this->request->get('type', '');
            $map['state'] = $this->request->get('state', '');

//            $row = helper::http_curl($this->book['list'], $map);
            $row = [];
            $list = $count = [];

            if (  isset($row['result']) && $row['result'] ) {
                $list = $row['data'];
                $count = $row['count_info']['count'];
            }

            $data = [
                'code'  => 0,
                'msg'   => '数据返回成功',
                'count' => $count,
                'data'  => $list
            ];

            AdminLog::setTitle('获取预约列表');
            return json($data);
        }else{

            $map['jigouid']     = input('get.id', 0, 'intval');
            $map['token']       = 'caea90167af2875c9243774ff0ef6150';
            $data = NULL;

            if( $map['jigouid']){
                $row   = helper::http_curl($this->resthome['info'], $map);

                if ($data['result']) {
                    $data = $row['data'];
                }
            }


            $this->assign('data', $data);
            return $this->fetch();
        }
    }

    /**
     * 添加
     * @return mixed
     */
    public function resthomeForm()
    {
        if ($this->request->isPost()) {
            $map['id']      = input('post.id', 0, 'intval');
            $map['cover']   = input('post.cover', 0, 'intval');
            $map['status']  = input('post.status', 0, 'intval');
            $map['content'] = input('post.content');
            $map['title']   = input('post.title');

            if ($map['id']) {
                $row = helper::http_curl($this->resthome['modifye'], $map);
            } else {
                $row = helper::http_curl($this->resthome['add'], $map);
            }

            if ($row) {
                $this->error($map['id'] ? '编辑' : '新增' . '成功');
            } else {
                AdminLog::setTitle('编辑预约');
                $this->success($map['id'] ? '编辑' : '新增' . '失败');
            }
        }

        $map['jigouid']     = input('get.id', 0, 'intval');
        $map['token']       = 'caea90167af2875c9243774ff0ef6150';
        $data = NULL;

        if( $map['jigouid']){
            $row   = helper::http_curl($this->resthome['info'], $map);

            if ($data['result']) {
                $data = $row['data'];
            }
        }


        $this->assign('data', $data);
        return $this->fetch();
    }
}