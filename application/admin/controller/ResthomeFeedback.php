<?php
/**----------------------------------------------------------------------
 * 机构评论管理
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
 * 机构评论管理
 * Class Article
 * @package app\admin\controller
 */
class ResthomeFeedback extends Base
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
                        'resthome_slogen' => '文章标题',
                        'resthome_name' => '评论人',
                        'resthome_short' => '评论内容',
                        'status' => '正常',
                        'resthome_time'=>'2018-12-2']
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

    /**
     * 回复
     */
    public function reply(){
        return $this->fetch();
    }
}