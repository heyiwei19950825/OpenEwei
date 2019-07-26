<?php
/**----------------------------------------------------------------------
 * EweiAdmin V3
 * Copyright 2014-2018 http://www.redkylin.com All rights reserved.
 * ----------------------------------------------------------------------
 * Author: ewei(ewei@dtyjkj.com)
 * Date: 2018/9/30
 * Time: 10:18
 * ----------------------------------------------------------------------
 */
namespace app\admin\model;

use think\model;

class ActionLimit extends model
{
    protected $table = USER . 'action_limit';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';

    /**
     * 获取用户行为限制列表
     * @author:wdx(wdx@ourstu.com)
     */
    public function getList($map = [], $page = 1, $limit = 20)
    {
        $list = $this->where($map)->page($page, $limit)->select();
        return $list;
    }
}