<?php
/**----------------------------------------------------------------------
 * 文章管理
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
 * 文章管理
 * Class Article
 * @package app\admin\controller
 */
class Article extends Base
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
                        'title' => '好文章',
                        'comments' => '300',
                        'share' => '20',
                        'thumbsup' => '20',
                        'create_time'=>'2018-12-2']
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

                AdminLog::setTitle('编辑广告');

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
                'title'=>'招聘广告',
                'source'  =>'来源',
                'author'=>'我是西红柿',
                'comments'=>'200',
                'views'=>'300',
                'level'=>'2',
                'content'=>'真的是一片好文章呀',
                'summary'=>'真的是一片好文章呀',
                'pagebelong'=>'60',
                'sortorder'=>'1',
                'statuss'=>'1',
                'commend'=>'1',
                'forbid_reserved'=>'1',
            );
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
     * 修改状态
     */
    public function update_status(){
        return $this->fetch();
    }
}