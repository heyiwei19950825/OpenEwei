<?php
/**----------------------------------------------------------------------
 * EweiAdmin V1
 * Copyright 2018-2018 http://www.redkylin.con All rights reserved.
 * ----------------------------------------------------------------------
 * Author: ewei(lamp_heyiwei@163.com)
 * Date: 2018/12/7
 * Time: 11:48
 * ----------------------------------------------------------------------
 */


namespace app\admin\controller;


use app\admin\model\AdminLog;

class Setting extends Base
{
    public function initialize()
    {

    }

    /**
     * 系统
     * @return mixed
     */
    public function system()
    {
        if ($this->request->isAjax()) {

            $map['keyword'] = $this->request->get('keyword', '');
            $map['mobile']  = $this->request->get('mobile', '');
            $map['sex']     = $this->request->get('sex', '');
            $map['status']  = $this->request->get('status', '');

            $data = [
                'code'  => 0,
                'msg'   => '数据返回成功',
            ];

            AdminLog::setTitle('获取列表');
            return json($data);
        }else{

            $config= [];
            $this->assign('config',$config);
            return $this->fetch();
        }
    }



    /**
     * 个人
     * @return mixed
     */
    public function personage()
    {
        if ($this->request->isAjax()) {

            $map['keyword'] = $this->request->get('keyword', '');
            $map['mobile']  = $this->request->get('mobile', '');
            $map['sex']     = $this->request->get('sex', '');
            $map['status']  = $this->request->get('status', '');

            $data = [
                'code'  => 0,
                'msg'   => '数据返回成功',
            ];

            AdminLog::setTitle('获取列表');
            return json($data);
        }else{
            return $this->fetch();
        }
    }

}