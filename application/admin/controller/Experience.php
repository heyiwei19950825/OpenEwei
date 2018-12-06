<?php
/**----------------------------------------------------------------------
 * 试住管理
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
 * 试住管理
 * Class Article
 * @package app\admin\controller
 */
class Experience extends Base
{
    protected $url = [];
    public function initialize()
    {
        //获取字典配置
        $this->distData();
        $this->url = config()['api']['book'];
    }

    /**
     * 试住管理
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

            $map['keyword'] = $this->request->get('keyword', '');
            $map['type'] = $this->request->get('type', '');
            $map['state'] = $this->request->get('state', '');
            $map['field'] = $this->request->get('field', 'id');
            $map['order'] = $this->request->get('order', 'desc');

//            $row = helper::http_curl($this->url['list'], $map);

            $row = [
                'result' => 'true',
                'count_info'    =>[
                    'count' =>100
                ],
                'data'=> [
                    ['id' => '1',
                        'user_name' => '老王',
                        'user_kindred' => '入驻',
                        'user_phone' => '176102239890',
                        'resthome_name' => '春树养老',
                        'resthome_contact' => '小王',
                        'resthome_phone' => '1761022299030',
                        'service_phase' => '试住阶段',
                        'service_status' => '正常',
                        'service_fristname' => '首次服务人',
                        'service_remarke' => '正常',
                        'state' => '正常']
                ]
            ];


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

            AdminLog::setTitle('获取试住列表');
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
            $map['book'] = $this->request->post();

            if ( isset( $map['id'] )&&!empty( $map['id'] ) ) {
                $row = helper::http_curl($this->url['update'], $map,'POST');
            } else {
                $row = helper::http_curl($this->url['save'], $map,'POST');
            }

            if ($row['result']) {
                AdminLog::setTitle('添加试住');
                $this->error($map['id'] ? '编辑成功' : '新增成功');
            } else {
                AdminLog::setTitle('编辑试住');
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

        $data = ['id' => '1',
            'name' => '老王',
            'age' => '32',
            'sex' => '男',
            'time' => '春树养老',
            'resthome' => '春树养老',
            'contact' => '小王',
            'mobile' => '1761022299030',
            'relation' => '64',
            'service_phase' => '1',
            'service_status' => '1',
            'remark' => '咋的啦',
            'state'=>1];

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
            AdminLog::setTitle('删除试住');
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