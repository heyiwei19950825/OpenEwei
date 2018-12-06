<?php
/**----------------------------------------------------------------------
 * 机构管理
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
 * 机构管理
 * Class Article
 * @package app\admin\controller
 */
class Resthome extends Base
{
    protected $url = [];
    public function initialize()
    {
        //获取字典配置
        $this->distData();
        $this->url = config()['api']['resthome'];
    }

    /**
     * 机构管理
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

            if($this->request->get('time-scope')){
                $time = $this->request->get('time-scope');
                $time = explode(' - ',$time);
                $map['sarttime'] = $time[0];
                $map['endtime'] = $time[1];
            }

            $map['name'] = $this->request->get('keyword', '');
            $map['brand_id'] = $this->request->get('brand_id', '');
            $map['nature'] = $this->request->get('nature', '');
            $map['type'] = $this->request->get('type', '');
            $map['state'] = $this->request->get('state', '');
            $map['field'] = $this->request->get('field', 'id');
            $map['order'] = $this->request->get('order', 'desc');

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

            AdminLog::setTitle('获取机构列表');
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
                AdminLog::setTitle('添加机构');
                $this->error($map['id'] ? '编辑成功' : '新增成功');
            } else {
                AdminLog::setTitle('编辑机构');
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
            AdminLog::setTitle('删除机构');
            $this->success('删除成功');
        }

        $this->error('删除失败');
    }

    /**
     * 图片弹窗
     * @return mixed
     */
    public function upPop(){
        return $this->fetch();
    }
    /**
     * 执照弹窗
     * @return mixed
     */
    public function licensePop( $id ){
        if($this->request->isPost()){
            $map = $this->request->post();

            $row = helper::http_curl($this->url['update_status'], $map,'post');
            $this->success('修改成功');

//            if ( isset($row['result']) && $row['result'] ) {
//                AdminLog::setTitle('修改机构状态');
//                $this->success('修改成功');
//            }
//            $this->error('修改失败');
        }

        $this->assign('id',$id);
        return $this->fetch();
    }

    /**
     * 执照弹窗
     * @return mixed
     */
    public function licenseDel( $id ){
        if($this->request->isPost()){
            $map = $this->request->post();

            $row = helper::http_curl($this->resthome['update_status'], $map,'post');
            $this->success('删除成功');

//            if ( isset($row['result']) && $row['result'] ) {
//                AdminLog::setTitle('删除机构执照');
//                $this->success('删除成功');
//            }
//            $this->error('删除失败');
        }

        $this->assign('id',$id);
        return $this->fetch();
    }

    /**
     * 审核
     */
    public function audit($id){
        if($this->request->isPost()){
            $map = $this->request->post();

            $row = helper::http_curl($this->resthome['update_status'], $map,'post');
            $this->success('修改成功');

//            if ( isset($row['result']) && $row['result'] ) {
//                AdminLog::setTitle('修改机构状态');
//                $this->success('修改成功');
//            }
//            $this->error('修改失败');
        }

        $this->assign('id',$id);
        return $this->fetch();
    }

    /**
     * 执照
     */
    public function license( $id ){
        if($this->request->isPost()){
            $map = $this->request->post();

            $row = helper::http_curl($this->resthome['update_status'], $map,'post');
            $this->success('修改成功');

//            if ( isset($row['result']) && $row['result'] ) {
//                AdminLog::setTitle('修改机构状态');
//                $this->success('修改成功');
//            }
//            $this->error('修改失败');
        }

        $this->assign('id',$id);
        return $this->fetch();
    }


    public function pos(){
        return $this->fetch();
    }
}