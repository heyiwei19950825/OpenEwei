<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/29
 * Time: 23:03
 */

namespace app\api\controller;

use app\common\model\ActivityOrder;

class Order extends Base
{
    protected $activityOrder;
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->activityOrder = new ActivityOrder();

    }
    /**
     * 查询我的订单列表
     */
    public function getOrderList(){
        if( $this->request->isPost()){
            $uId    = $this->request->post('u_id');
            $status = $this->request->post('status');
            $field  = 'a.id,a.imgs_url,a.depart_time_name,a.address_name,a.desc,a.hold_type,a.status,o.order_sn,o.money,o.id as o_id,o.status as o_status,o.pay_status,o.create_time,o.pay_type,o.integral';
            if($status!= 0 ){
                $where['o.status']=$status -1;
            }
            $where['o.u_id'] = $uId;
            $row = $this->activityOrder->selectOrderListByApi($field ,$where,1,10);

            if( $row ){
                $result = [
                    'error'   => 0,
                    'message' => '查询成功',
                    'data'=>$row
                ];
            }else{
                $result = [
                    'error'   => 1,
                    'message' => '查询失败，请检测网络重新尝试',

                ];
            }
            return json($result);
        }
    }

    /**
     * 未支付订单
     */
    public function nonPay(){
        if( $this->request->isPost()) {
            $uId = $this->request->post('u_id');
            $row = $this->activityOrder->field('order_sn,money')->where(['u_id' => $uId,'pay_status'=>0])->find();
            if( $row ){
                $result = [
                    'error'   => 0,
                    'message' => '查询成功',
                    'data'=>null
                ];
            }else{
                $result = [
                    'error'   => 0,
                    'message' => '查询成功',

                ];
            }
            return json($result);
        }
    }
    /**
     * 修改订单数据
     */
    public function updateOrder(){
        if( $this->request->isPost()) {
            $uId        = $this->request->post('u_id');
            $orderSn    = $this->request->post('order_sn');
            $row = $this->activityOrder->where(['u_id' =>$uId,'order_sn'=>$orderSn])->update([
                'status' => 1,
                'pay_status' => 1,
            ]);

            if( $row ){
                $result = [
                    'error'   => 0,
                    'message' => '支付成功',
                ];
            }else{
                $result = [
                    'error'   => 1,
                    'message' => '支付失败，请检测网络重新尝试',

                ];
            }
            return json($result);
        }
    }

    /**
     * 删除订单
     */
    public function delOrder(){

    }
}