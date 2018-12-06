<?php
/**----------------------------------------------------------------------
 * 用户管理
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
class User extends Base
{
    protected $url = [];
    protected $old = [];
    public function initialize()
    {
        $this->distData();
        $this->url = config()['api']['user'];
        $this->old = config()['api']['user']['old'];
    }

    /**
     * 用户管理
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

            $row = helper::http_curl($this->url['list'], $map);
            $list = $count = [];

            if ($row['result']) {
                $list   = $row['data'];
                $count = $row['count_info']['count'];
            }

            $data = [
                'code'  => 0,
                'msg'   => '数据返回成功',
                'count' => $count,
                'data'  => $list
            ];

            AdminLog::setTitle('获取用户列表');
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
            $map = [
                'token'     => 'caea90167af2875c9243774ff0ef6150',
                'userid'    => session('admin_auth')['uid'],
            ];

            $map['user']     = $this->request->post();

            if ( isset( $map['user']['id'] )&&!empty( $map['user']['id'] ) ) {
                $row = helper::http_curl($this->url['update'], $map,'POST');
            } else {
                $row = helper::http_curl($this->url['save'], $map,'POST');
            }

            if ($row['result']) {
                $this->success($map['user']['id'] ? '编辑成功' : '新增成功');
            } else {

                AdminLog::setTitle('编辑用户');

                $this->error($map['user']['id'] ? '编辑失败' : '新增失败');
            }
        }

        $map['id']     = input('get.id', 0, 'intval');
        $map['token']       = 'caea90167af2875c9243774ff0ef6150';
        $data = NULL;

        if( $map['id']){

            $row   = helper::http_curl($this->url['info'], $map);
            $row['data'] = array(
                'id'        => 10,
                'username'=>'测试',
                 'sex'  =>'famale',        //'male','famale'
                 'type'=>'personal',       //'resthome','personal'
                 'email'=>'personal@qq.com',
                 'mobile'=>'17610226808'
            );
            if ($row['result']) {
                $data = $row['data'];
            }
        }


        $this->assign('data', $data);
        return $this->fetch();


    }

    /**
     * 删除用户
     * @author:wdx(wdx@ourstu.com)
     */
    public function del()
    {
        $map = [
            'token'         => 'caea90167af2875c9243774ff0ef6150',
            'userid'        => session('admin_auth')['uid'],
            'id'            => trim(implode(',',array_unique(input('post.id/a', [])) ),',')
        ];

        $row = helper::http_curl($this->url['delete'], $map,'post');

        if ( isset($row['result']) && $row['result'] ) {
            AdminLog::setTitle('删除机构招聘');
            $this->success('删除成功');
        }

        $this->error('删除失败');
    }

    /**
     * 老人信息弹窗
     */
    public function oldPop(){
        if ($this->request->isAjax()) {
            $map = [
                'token'     => 'caea90167af2875c9243774ff0ef6150',
                'pageindex' => input('get.page/d', 1),
                'pagesize'  => input('get.limit/d', 10)
            ];

            if($this->request->get('time-scope')){
                $time = $this->request->get('time-scope');
                $time = explode(' - ',$time);
                $map['sarttime'] = $time[0];
                $map['endtime'] = $time[1];
            }

//            $map['name'] = $this->request->get('name', '');
//            $map['mobile'] = $this->request->get('mobile', '');
//            $map['state'] = $this->request->get('state', '');

            $row = helper::http_curl($this->old['list'], $map);
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

            AdminLog::setTitle('老人信息列表');
            return json($data);
        }else{
            return $this->fetch();
        }
    }
    /**
     * 老人信息
     */
    public function oldUser(){
        if ($this->request->isAjax()) {
            $map = [
                'token'     => 'caea90167af2875c9243774ff0ef6150',
                'pageindex' => input('get.page/d', 1),
                'pagesize'  => input('get.limit/d', 10)
            ];

            if($this->request->get('time-scope')){
                $time = $this->request->get('time-scope');
                $time = explode(' - ',$time);
                $map['sarttime'] = $time[0];
                $map['endtime'] = $time[1];
            }

//            $map['name'] = $this->request->get('name', '');
//            $map['mobile'] = $this->request->get('mobile', '');
//            $map['state'] = $this->request->get('state', '');

            $row = helper::http_curl($this->old['list'], $map);
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

            AdminLog::setTitle('获取用户列表');
            return json($data);
        }else{
            return $this->fetch();
        }
    }
    /**
     * 添加
     * @return mixed
     */
    public function oldForm()
    {
        if ($this->request->isPost()) {
            $map = [
                'token'     => 'caea90167af2875c9243774ff0ef6150',
                'userid'    => session('admin_auth')['uid'],
            ];
            $map['elder']     = $this->request->post();

            if ( isset( $map['elder']['id'] )&&!empty( $map['elder']['id'] ) ) {
                $row = helper::http_curl($this->old['update'], $map,'POST');
            } else {
                $row = helper::http_curl($this->old['save'], $map,'POST');
            }

            if ($row['result']) {
                $this->success($map['elder']['id'] ? '编辑成功' : '新增成功');
            } else {

                AdminLog::setTitle('编辑老人');

                $this->error($map['elder']['id'] ? '编辑失败' : '新增失败');
            }
        }

        $map['id']     = input('get.id', 0, 'intval');
        $map['token']       = 'caea90167af2875c9243774ff0ef6150';
        $data = null;

        if( $map['id']){
            $row   = helper::http_curl($this->old['info'], $map);

            if ($row['result']) {
                $data = $row['data'][0];
            }
        }

        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 删除老人信息
     * @author:wdx(wdx@ourstu.com)
     */
    public function delOld()
    {

        $map = [
            'token'         => 'caea90167af2875c9243774ff0ef6150',
            'userid'        => session('admin_auth')['uid'],
            'id'            => trim(implode(',',array_unique(input('post.id/a', [])) ),',')
        ];

        $row = helper::http_curl($this->old['delete'], $map,'post');

        if ( isset($row['result']) && $row['result'] ) {
            AdminLog::setTitle('删除老人信息');
            $this->success('删除成功');
        }

        $this->error('删除失败');
    }
}