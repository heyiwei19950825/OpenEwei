<?php
/**----------------------------------------------------------------------
 * OpenEwei V3
 * Copyright 2014-2018 http://www.redkylin.com All rights reserved.
 * ----------------------------------------------------------------------
 * Author: ewei(ewei@dtyjkj.com)
 * Date: 2018/10/15
 * Time: 13:06
 * ----------------------------------------------------------------------
 */

namespace app\admin\model;

use think\model;

/**
 * Class IPBlackList
 * IP黑名单
 * @package app\admin\model
 */
class IPBlackList extends Model
{
    protected $table = COMMON . 'ip_black_list';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
}