<?php
/**----------------------------------------------------------------------
 * EweiAdmin V3
 * Copyright 2014-2018 http://www.redkylin.com All rights reserved.
 * ----------------------------------------------------------------------
 * Author: lin(lt@ourstu.com)
 * Date: 2018/9/13
 * Time: 14:23
 * ----------------------------------------------------------------------
 */

namespace app\api\controller;

use app\common\model\Activity as ActivityModel;
use app\common\model\User as UserModel;
use app\common\model\ActivityUser as ActivityUserModel;
use app\common\model\Order as OrderModel;
use app\common\model\ActivityHold;
use app\common\model\ActivityTeamType;
use app\common\model\ActivityCharge;
use app\common\model\ActivityOrder;
use org\Helper;
use think\Db;

class Activity extends Base
{
    protected $activity;
    protected $user;
    protected $activityUser;
    protected $order;
    protected $activityTeamType;//活动队伍类型
    protected $activityCharge;//活动收费标砖
    protected $activityHold;//活动举办类型
    protected $activityOrder;//活动订单

    public function initialize()
    {
        parent::initialize();
        //实例化model层
        $this->activityUser     =  new ActivityUserModel();
        $this->activityHold     =  new ActivityHold();
        $this->activityCharge   =  new ActivityCharge();
        $this->activityTeamType =  new ActivityTeamType();
        $this->activityOrder    =  new ActivityOrder();
        $this->activity         =  new ActivityModel();
        $this->order            =  new OrderMOdel();
        $this->user             =  new UserModel();
    }

    /**
     * 活动配置基础信息
     */
    public function base(){

        //查询开启的举办类型
        $activityHold       = $this->activityHold->where(['status'=>1])->select();
        //查询收费类型
        $activityCharge     = $this->activityCharge->where(['status'=>1])->select();
        foreach ($activityHold as $holdK=>&$holdV){
            $holdV['rule'] = explode(',',$holdV['rule']);
        }
        //查询队伍类型
        $activityTeamType   = $this->activityTeamType->where(['status'=>1])->select();
        $result = [
            'error'   => 0,
            'message' => '获取成功',
            'data'    =>[
                'hold'=>$activityHold,
                'charge'=>$activityCharge,
                'teamType'=>$activityTeamType,
            ]
        ];

        return json($result);
    }
    /**
     * 创建或编辑活动
     */
    public function form(){
        if( $this->request->isPost()){
            $params = $this->request->post();
            $row = $this->activity->formByApi($params);
            if( $row ){
                //添加自己到报名列表中
                if(!isset( $params['id']) ){
                    $this->activityUser->save([
                        'u_id' => $params['u_id'],
                        'a_id' => isset( $params['id'] )? $params['id']:$row,
                        'status' => 1
                    ]);
                }

                $result = [
                    'error'   => 0,
                    'message' => '创建成功',
                    'id'=>isset( $params['id'] )? $params['id']:$row
                ];
            }else{
                $result = [
                    'error'   => 1,
                    'message' => '创建失败，请检测网络重新尝试',

                ];
            }

            return json($result);
        }

    }

    /**
     * 活动详情
     */
    public function info(){
        if( $this->request->isPost() ){
            $id = $this->request->post('id');
            $u_id = $this->request->post('u_id');
            $row = [
                'info'=>[],
                'user_info'=>[],
                'apply'=>[
                    'data'=>[],
                    'count'=>[]
                ]
            ];

            //活动详情
            $row['info'] = $this->activity->getInfoById( $id );
            //创建者详情
            $row['user_info'] = $this->user->getInfoById($row['info']['u_id']);
            //获取报名信息
            $apply = $this->activityUser->alias('au')->field('u.username,u.profile,au.*')->join('user u','u.id = au.u_id')->where(['au.a_id'=>$id])->select();
            //查询来源用户名称
            foreach ($apply as $k=> $v){
                $v['from_name'] = $this->user->field('username')->where(['id'=>$v['from_id']])->find()['username'];
            }
            //统计参与用户数据
            $applyCount = [
                'affirm' => 0,
                'uncertain'=>0,
                'leave'=>0,
            ];

            //当前用户报名状态
            $row['info']['apply_status']  = 0;

            //1 已报名 2待定 3请假
            foreach ($apply as $k =>$v){

                //监测用户是否存在报名中
                if( $v['u_id'] == $u_id){
                    $row['info']['apply_status']  = $v['status'];
                }
                if($v['status'] == 1){
                    $applyCount['affirm']++;
                }
                if($v['status'] == 2){
                    $applyCount['uncertain']++;
                }
                if($v['status'] == 3){
                    $applyCount['leave']++;
                }
            }
            $row['apply']['data'] = $apply;
            $row['apply']['count'] = $applyCount;

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
     * 活动列表
     */
    public function getList(){
        if($this->request->isPost()){
            $params = $this->request->post();
            $where = [];
            $desc = '';
            //判断查询的数据类型  0是全部活动 1 是我的活动  2是推荐活动  3是我参与的活动
            switch ($params['type']){
                case 1://查询我发布的活动
                    $where['a.u_id'] = $params['u_id'];
                    $limit = isset( $params['page_size'] )? $params['page_size']:3;
                    break;
                case 2:
                    $limit = 10;
                    break;
                case 3://查找我参加的和我发布的活动
                    switch ($params['list_status']){
                        case 2:
                            $where['a.u_id'] =  $params['u_id'];
                            break;
                        case 3:
                            $where['a.u_id'] =  ['<>',$params['u_id']];
                            break;
                    }
                    $where['au.u_id'] = $params['u_id'];
                    $limit = isset( $params['page_size'] )? $params['page_size']:3;
                    break;
            }

            // 1 综合排序   2 开始时间排序 3 距离排序
            switch ($params['order']){
                case 1:
                    $desc = 'a.id desc';
                    break;
                case -1:
                    $desc = 'a.id desc';
                    break;
                case 2:
                    $desc = 'depart_time desc';
                    break;
                case 3:
                    break;
            }
            //查找战队活动
            if( isset( $params['team_id'] ) ){
                $where['a.team_id'] = $params['team_id'];
            }
            //是否是私密活动
            if( isset( $params['privacy'] ) && $params['privacy'] == 1){
                $where['a.privacy'] = 0;
            }

            //经纬度 用户
            $lat    = $params['lat'];
            $lng    = $params['lng'];
            $field  = "a.id,a.address_name,a.people_number,a.u_id,a.create_time,a.imgs_url,a.charge_type,a.team_type,a.depart_time_name,a.create_time,a.desc,a.status,u.username,u.profile,ROUND(6378.138*2*ASIN(SQRT(POW(SIN(($lat*PI()/180-a.latitude*PI()/180)/2),2)+COS($lat*PI()/180)*COS(a.latitude*PI()/180)*POW(SIN(($lng*PI()/180-a.longitude*PI()/180)/2),2)))*1000) AS distance";
            //判断是否是查询我创建的活动和我参加的活动
            if( $params['type'] == 3){
                $row    = $this->activity->selectMyByApi( $field,$where,$params['page'],$limit,$desc );
            }else{
                $row    = $this->activity->selectByApi( $field,$where,$params['page'],$limit,$desc );
            }

            if( $row ){
                $result = [
                    'error'     => 0,
                    'message'   => '查询成功',
                    'data'      => $row
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
     * 请假待定
     */
    public function leave(){
        if( $this->request->post() ) {
            $params = $this->request->post();
            //查询是否参加活动
            $isset = $this->activityUser->where([
                'u_id'=>$params['u_id'],
                'a_id'=>$params['id']
            ])->find();

            if($isset){
                //修改用户参加状态
                $row = $this->activityUser->where([
                    'u_id'=>$params['u_id'],
                    'a_id'=>$params['id']
                ])->update([
                    'status'=>$params['status']
                ]);
            }else{
                $result = [
                    'error'   => 1,
                    'message' => '您还没有报名',
                ];
                return json($result);
            }


            if( $row ){
                $result = [
                    'error'   => 0,
                    'message' => '报名成功',
                    'data'=>$row
                ];
            }else{
                $result = [
                    'error'   => 1,
                    'message' => '报名失败，请检测网络重新尝试',
                ];
            }
            return json($result);
        }
    }
    /**
     * 用户报名
     */
    public function apply(){
        if( $this->request->post() ){
            $params = $this->request->post();

            //添加活动用户列表
            if( !$this->activityUser->where([ 'u_id' => $params['u_id'], 'a_id' => $params['id'],'from_id'=>$params['from']])->find() ){
                // 启动事务
                Db::startTrans();
                try{
                    $row = $this->activityUser->save([
                        'u_id' => $params['u_id'],
                        'a_id' => $params['id'],
                        'from_id'=>$params['from'],
                        'status' => 1
                    ]);
                    //查询活动信息
                    $activityInfo = $this->activity->where(['id'=>$params['id']])->find();

                    //创建用户订单
                    $orderData['order_sn'] = Helper::createOrderNumber();
                    $orderData['u_id'] = $params['u_id'];
                    $orderData['a_id'] = $params['id'];
                    $orderData['money'] = $activityInfo['money'];
                    $orderData['pay_type'] = $activityInfo['money'] == 0 ?1 :2 ;//判断是否是付费的

                    //创建订单
                    $orderRow  = $this->activityOrder->save($orderData);
                    if(!$orderRow || !$row){
                        Db::rollback();
                        $result = [
                            'error'   => 1,
                            'message' => '报名失败，请检测网络重新尝试',
                        ];
                        return json($result);
                    }
                    // 提交事务
                    Db::commit();
                } catch (\Exception $e) {
                    echo  $e;die;
                    // 回滚事务
                    Db::rollback();
                    $result = [
                        'error'   => 1,
                        'message' => '报名失败，请检测网络重新尝试',
                    ];
                    return json($result);
                }


            }else{
                $result = [
                    'error'   => 1,
                    'message' => '您已报过名了',
                ];

                return json($result);
            }

            if( $row ){
                $result = [
                    'error'   => 0,
                    'message' => '报名成功',
                    'data'=>$row
                ];
            }else{
                $result = [
                    'error'   => 1,
                    'message' => '报名失败，请检测网络重新尝试',
                ];
            }
            return json($result);

        }
    }
    /**
     * 删除活动列表
     */
    public function doDel(){

    }

    /**
     * 修改活动状态
     */
    public function updateStatus(){
        if( $this->request->isPost()){
            $params = $this->request->post();
            $row = $this->activity->where([
                'id'=>$params['id'],
                'u_id'=>$params['u_id'],
            ])->update(['status'=>$params['status']]);
            if($params['status'] == 4){
                $this->activityOrder->where([
                    'a_id'=>$params['id']
                ])->update(['status'=>3]);
            }

            if($row){
                $result = [
                    'error'   => 0,
                    'message' => '修改成功',
                ];
                return json($result);
            }else{
                $result = [
                    'error'   => 1,
                    'message' => '修改失败',
                ];
                return json($result);
            }
        }
    }




}