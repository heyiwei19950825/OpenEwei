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
use think\Db;

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
        //获取数据信息
        $config = Db::name('system')->where(['id'=>1])->find();
        AdminLog::setTitle('获取配置文件信息');

        $this->assign('config',$config);
        return $this->fetch();
    }

    /**
     * 编辑
     */
    public function systemForm(){
        if( $this->request->isAjax()){
            $params = $this->request->post();

            Db::name('system')->where([
                "id"=>1
            ])->update($params['data']);

            $data = [
                'code'  => 0,
                'msg'   => '修改成功',
            ];
            AdminLog::setTitle('修改配置文件');
            return json($data);
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