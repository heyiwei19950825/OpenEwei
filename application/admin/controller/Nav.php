<?php
/**----------------------------------------------------------------------
 * OpenCenter V3
 * Copyright 2014-2018 http://www.ocenter.cn All rights reserved.
 * ----------------------------------------------------------------------
 * Author: lin(lt@ourstu.com)
 * Date: 2018/9/13
 * Time: 14:23
 * ----------------------------------------------------------------------
 */

namespace app\admin\controller;

use app\admin\model\AdminLog;
use app\common\layout\Iframe;
use org\Helper;
use org\WxJsConfig;

class Nav extends Admin
{
    protected $nav;
    protected $navCategory;

    public function initialize()
    {
        parent::initialize();
        //请求参数过滤【剥去字符串中的 HTML、XML 以及 PHP 的标签。】
        $this->request->filter(['strip_tags']);

        //实例化model层
        $this->nav          = model('Nav');
        $this->navCategory  = model('NavCategory');
    }

    /**
     * 菜单管理
     * @return mixed
     */
    public function index(){
        $wxJsConfig = new WxJsConfig();
        $config = $wxJsConfig->getJsConfig();
        var_dump(json_decode($config,true));die;




        $return = builder('list')
            ->setPageTitle('导航管理')
            ->setDataUrl(url('admin/action/actionLimit'))
            ->addTopBtn('addnew',array('href'=>url('edit',['pid'=>1])))  // 添加新增按钮
            ->addTopBtn('resume',array('model'=>'auth_rule'))  // 添加启用按钮
            ->addTopBtn('forbid',array('model'=>'auth_rule'))  // 添加禁用按钮
            ->addTopBtn('delete',array('model'=>'auth_rule'))  // 添加删除按钮
//            ->setTabNav([['title' => '标题','href' => url('/admin/nav/index')],['title' => '标题','href' => 'http://www.xxx.cn']],0)  // 设置页面Tab导航
            ->setSearch('', url('rule'))
            ->keyListItem('id','ID',true)
            ->keyListItem('title','标题',true,true)
            ->keyListItem('rule_title','权限节点名称',true,true)
            ->keyListItem('frequency','频率')
            ->keyListItem('is_menu','菜单')
            ->keyListItem('status','状态','status')
            ->keyListItem('right_button', '操作', 'btn')
            ->openPage(true) // 数据列表分页
            ->setListLimit(20) // 数据列表分页
            ->setListLimits([10, 20, 50, 100])
            ->addRightButton('edit')      // 添加编辑按钮
            ->addRightButton('forbid',['model'=>'auth_rule'])// 添加启用禁用按钮
            ->alterListData(
                array('key' => 'pid', 'value' =>'0'),
                array('parent_menu' => '无'))
            ->fetch();

        return  Iframe()->setMetaTitle('菜单栏管理')->search([
            ['name'=>'status','type'=>'select','title'=>'状态','options'=>[1=>'正常',2=>'待审核']],
            ['name'=>'sex','type'=>'select','title'=>'性别','options'=>[0=>'未知',1=>'男',2=>'女']],
            ['name'=>'create_time_range','type'=>'daterange','extra_attr'=>'placeholder="注册时间"'],
            ['name'=>'keyword','type'=>'text','extra_attr'=>'placeholder="请输入查询关键字"'],
        ])->content($return);
    }

    /**
     * 菜单表单
     * @return mixed
     */
    public function form(){


    }

    /**
     * 菜单删除
     * @return mixed
     */
    public function del()
    {

    }

}