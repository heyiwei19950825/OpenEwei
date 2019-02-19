<?php
/**----------------------------------------------------------------------
 * OpenEwei V3
 * Copyright 2014-2018 http://www.redkylin.com All rights reserved.
 * ----------------------------------------------------------------------
 * Author: ewei(ewei@dtyjkj.com)
 * Date: 2018/9/26
 * Time: 15:45
 * ----------------------------------------------------------------------
 */
namespace app\admin\behavior;

class UserLog
{
    public function run($params)
    {
        if (is_user_login()) {
            \app\admin\model\UserLog::record($params);
        }
    }
}