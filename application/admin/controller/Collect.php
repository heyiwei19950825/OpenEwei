<?php
/**----------------------------------------------------------------------
 * EweiAdmin V1
 * Copyright 2018-2018 http://www.redkylin.con All rights reserved.
 * ----------------------------------------------------------------------
 * Author: ewei(lamp_heyiwei@163.com)
 * Date: 2019/4/30
 * Time: 10:27
 * ----------------------------------------------------------------------
 */
namespace app\admin\controller;

use app\admin\model\AdminLog;

class Collect extends Base{



    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
    }


    public function config(){

        return $this->fetch();
    }
}