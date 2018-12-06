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

class ScoreType extends Validate
{
    /**
     * 验证规则
     */
    protected $rule = [
        'title' =>  'require',
        'unit' => 'require'
    ];

    /**
     * 提示消息
     */
    protected $message  =   [
        'title.require' => '积分名称必填',
        'unit.require' => '积分单位必填'
    ];
}