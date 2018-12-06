<?php
/**----------------------------------------------------------------------
 * 机构招聘招聘管理
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
 * 机构招聘招聘管理
 * Class Article
 * @package app\admin\controller
 */
class ResthomeRecruit extends Base
{
    protected $url = [];
    public function initialize()
    {
        //获取字典配置
        $this->distData();
        $this->url = config()['api']['resthome_job'];
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

    /**
     * 添加
     * @return mixed
     */
    public function form()
    {
        if ($this->request->isPost()) {
            $map['token']    = 'caea90167af2875c9243774ff0ef6150';
            $map['userid']   = session('admin_auth')['uid'];
            $map['resthome'] = $this->request->post();

            if ( isset( $map['id'] )&&!empty( $map['id'] ) ) {
                $row = helper::http_curl($this->url['update'], $map,'POST');
            } else {
                $row = helper::http_curl($this->url['save'], $map,'POST');
            }

            if ($row['result']) {
                AdminLog::setTitle('添加机构招聘');
                $this->error($map['id'] ? '编辑成功' : '新增成功');
            } else {
                AdminLog::setTitle('编辑机构招聘');
                $this->success($map['id'] ? '编辑失败' : '新增失败');
            }
        }

        $map['id']     = input('get.id', 0, 'intval');
        $map['token']       = 'caea90167af2875c9243774ff0ef6150';
        $data = NULL;
        if( $map['id']){
            $row   = helper::http_curl($this->url['info'], $map);

            if ($row['result']) {
                $data = $row['data'];
            }
        }

        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 删除
     * @author:wdx(wdx@ourstu.com)
     */
    public function del()
    {
        $map = [
            'token'         => 'caea90167af2875c9243774ff0ef6150',
            'userid'        => session('admin_auth')['uid'],
            'id'    => trim(implode(',',array_unique(input('post.id/a', [])) ),',')
        ];

        $row = helper::http_curl($this->url['delete'], $map,'post');

        if ( isset($row['result']) && $row['result'] ) {
            AdminLog::setTitle('删除机构招聘');
            $this->success('删除成功');
        }

        $this->error('删除失败');
    }

    /**
     * 修改状态
     */
    public function update_status(){
        return $this->fetch();
    }
}