<?php
/**
 * Created by PhpStorm.
 * User: 贺宜伟【ewei】
 * Date: 2018/11/22
 * Time: 11:04
 */

namespace app\admin\controller;


use think\Controller;

class Common extends Controller
{
    public function getCity(){
        if($this->request->isPost()){
            $id     = $this->request->post('id');

            $row = db('city')->where(array(
                'reid'    => $id
            ))->select();

            $data = [
                'code'  => 0,
                'msg'   => '数据返回成功',
                'data'  => $row
            ];

            return json($data);
        }
    }
}