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

class Nav extends Base
{
    protected $nav;
    protected $navCategory;

    public function initialize()
    {
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
        $row = [];
        return  (new Iframe())->setMetaTitle('菜单栏管理')->search([
            ['name'=>'status','type'=>'select','title'=>'状态','options'=>[1=>'正常',2=>'待审核']],
            ['name'=>'sex','type'=>'select','title'=>'性别','options'=>[0=>'未知',1=>'男',2=>'女']],
            ['name'=>'create_time_range','type'=>'daterange','extra_attr'=>'placeholder="注册时间"'],
            ['name'=>'keyword','type'=>'text','extra_attr'=>'placeholder="请输入查询关键字"'],
        ])->content($row);
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