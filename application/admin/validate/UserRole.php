<?php
/**----------------------------------------------------------------------
 * EweiOpen V3
 * Copyright 2017-2018 http://www.redkylin.con All rights reserved.
 * ----------------------------------------------------------------------
 * Author: ewei(lamp_heyiwei@163.com)
 * Date: 2018/9/30
 * Time: 14:00
 * ----------------------------------------------------------------------
 */
namespace app\admin\validate;

use think\Validate;

class UserRole extends Validate
{
    /**
     * 验证规则
     */
    protected $rule = [
        'name' =>  'require|unique:user_role',
        'pid' =>  'require',
        'sort' =>  'require',
        'rules' => 'require'
    ];

    /**
     * 提示消息
     */
    protected $message  =   [
        'title.require' => '角色名必填',
        'pid.require' => '父级角色必选',
        'sort.require' => '排序必填',
        'rules.require' => '权限必选'
    ];
}