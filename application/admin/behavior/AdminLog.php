<?php
/**----------------------------------------------------------------------
 * EweiOpen V3
 * Copyright 2017-2018 http://www.redkylin.con All rights reserved.
 * ----------------------------------------------------------------------
 * Author: ewei(lamp_heyiwei@163.com)
 * Date: 2018/9/26
 * Time: 15:45
 * ----------------------------------------------------------------------
 */
namespace app\admin\behavior;

class AdminLog
{
    public function run($params)
    {
        if (is_admin_login()) {
            \app\admin\model\AdminLog::record($params);
        }
    }

}