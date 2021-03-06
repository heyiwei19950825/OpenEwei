<?php
/**----------------------------------------------------------------------
 * EweiAdmin V3
 * Copyright 2014-2018 http://www.redkylin.com All rights reserved.
 * ----------------------------------------------------------------------
 * Author: ewei(ewei@dtyjkj.com)
 * Date: 2018/10/17
 * Time: 19:45
 * ----------------------------------------------------------------------
 */
namespace app\admin\model;

use think\model;

class ScoreRule extends model
{
    protected $table = USER . 'score_rule';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';

    public function getList($map = [], $page = 1, $row = 20)
    {
        $data = $this->where($map)->page($page, $row)->select();
        return $data;
    }

}