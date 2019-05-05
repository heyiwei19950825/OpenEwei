<?php
/**----------------------------------------------------------------------
 * OpenEwei V1
 * Copyright 2018-2018 http://www.redkylin.con All rights reserved.
 * ----------------------------------------------------------------------
 * Author: ewei(lamp_heyiwei@163.com)
 * Date: 2019/5/5
 * Time: 14:48
 * ----------------------------------------------------------------------
 */

namespace app\admin\validate;
use think\Validate;

class Task extends Validate
{
    /**
     * 验证规则
     */
    protected $rule = [
        'name' =>  'require|unique:name',
        'model' => 'require',
    ];

    /**
     * 提示消息
     */
    protected $message  =   [
        'name.require' => '名称名必填',
        'name.unique' => '名称已存在',
        'model.require' => '模块必填',
    ];
}