<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/12
 * Time: 14:01
 */

namespace app\common\model;


use org\Helper;
use think\Db;
use think\Model;

class Activity extends Model
{
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';


    public $charge      =  ['自定义收费','固定收费','AA收费','免费'];
    public $teamType    =  ['待定', '5人场', '7人场'];
    /**
     * 序列化photo图集
     * @param $value
     * @return string
     */
    protected function setPhotoAttr($value)
    {
        return serialize($value);
    }

    /**
     * 反序列化photo图集
     * @param $value
     * @return mixed
     */
    protected function getPhotoAttr($value)
    {
        return unserialize($value);
    }


    /**
     * 序列化photo图集
     * @param $value
     * @return string
     */
    protected function setThumbAttr($value)
    {
        return serialize($value);
    }

    /**
     * 反序列化photo图集
     * @param $value
     * @return mixed
     */
    protected function getThumbAttr($value)
    {
        return unserialize($value);
    }

    /**
     * 发布时间
     * @return bool|string
     */
    protected function getPublishTimeAttr($value)
    {
        return date('Y-m-d', $value);
    }


    /**
     * 数据查询
     * @param array $map      查询条件
     * @param array $field    过滤词
     * @param int $page       页码
     * @param int $limit      每页数量
     * @return array|mixed|\PDOStatement|string|\think\Collection
     */
    public function select( $map=[],$field="",$page=1,$limit=30 ){
        $article_list['data'] = $this->field($field)
            ->alias('a')
            ->join('user u','a.u_id = u.id')
            ->join('activity_hold h', 'a.hold_type = h.id')
            ->field($field)
            ->where($map)
            ->page($page, $limit)
            ->select();

        $article_list['count'] = $this->count(1);



        return $article_list;

    }

    /**
     * 接口修改或创建活动
     * @param $params
     * @return Activity|int|string
     */
    public function formByApi( $params ){
        $params['imgs_url'] = json_encode($params['imgs_url']);
        $params['depart_time_name'] = $params['depart_time'];
        $params['depart_time'] = explode('(', $params['depart_time']);
        $params['depart_time'][1] = explode(')', $params['depart_time'][1]);
        $params['depart_time'] = strtotime(date('Y').'-'.$params['depart_time'][0].' '.$params['depart_time'][1][1]);
        if( isset( $params['id'] ) ){
            $id = $params['id'];
            unset($params['id']);
            unset($params['apply_status']);
            unset( $params['update_time'] );
            $row = $this->allowField(true )->where(['id'=>$id])->update($params);
        }else{
            $row = $this->insertGetId($params);
        }

        return $row;
    }

    /**
     * 通过ID获取活动详情
     * @param $id
     * @return mixed
     */
    public function getInfoById( $id ){
        $row = $this->where(['id'=>$id])->find();
        //队伍类型
        $teamTypeModel  = new ActivityTeamType();
        $teamType       = $teamTypeModel->where(['status'=>1])->select();
        foreach ( $teamType as $teamTypeK =>$teamTypeV){
            if($teamTypeV['id'] == $row['team_type']){
                $row['team_type_name'] = $teamTypeV['name'];
            }
        }
        $row['imgs_url'] = json_decode($row['imgs_url'],true);

        return $row;
    }


    /**
     * 接口查询数据数据查询
     * @param array $map      查询条件
     * @param int $page       页码
     * @param int $limit      每页数量
     * @param string $limit      拍讯
     * @return array|mixed|\PDOStatement|string|\think\Collection
     */
    public function selectByApi( $field='' ,$map=[],$page=1,$limit=30, $desc = 'id desc' ){
        $article_list['data'] = $this->field($field)
            ->alias('a')
            ->join('user u','a.u_id = u.id')
            ->where($map)
            ->page($page, $limit)
            ->order($desc)
            ->select();

        $article_list['count'] = $this->count(1);
        $chargeModel    = new ActivityCharge();
        $teamTypeModel  = new ActivityTeamType();
        $charge         = $chargeModel->where(['status'=>1])->select();
        $teamType       = $teamTypeModel->where(['status'=>1])->select();

        //数据处理
        foreach ($article_list['data'] as $k=> &$v){
            foreach ( $charge as $chargeK =>$chargeV){
                if($chargeV['id'] == $v['charge_type']){
                    $v['charge_type_name'] = $chargeV['name'];
                }
            }
            foreach ( $teamType as $teamTypeK =>$teamTypeV){
                if($teamTypeV['id'] == $v['team_type']){
                    $v['team_type_name'] = $teamTypeV['name'];
                }
            }

            $v['imgs_url']          =  json_decode($v['imgs_url'],true);
            $v['distance']          =  $v['distance']/1000 > 1 ?round($v['distance']/1000,2).'km' : $v['distance'].'m';
            $v['create_time_name']  =  Helper::secsToStr($v['create_time']);
            $v['user_list']         = Db::name('activity_user')->alias('au')->field('u.profile')->join('user u','u.id = au.u_id')->where(['au.a_id'=>$v['id']])->select();
            $v['apply_count']       = Db::name('activity_user')->alias('au')->field('u.profile')->join('user u','u.id = au.u_id')->where(['au.a_id'=>$v['id'],'au.status'=>1])->count();
        }

        return $article_list;

    }

    /**
     * 接口查询数据数据查询
     * @param array $map      查询条件
     * @param int $page       页码
     * @param int $limit      每页数量
     * @param string $limit      拍讯
     * @return array|mixed|\PDOStatement|string|\think\Collection
     */
    public function selectMyByApi( $field='' ,$map=[],$page=1,$limit=30, $desc = 'id desc' ){
        $article_list['data'] = Db::name('activity_user')
            ->alias('au')
            ->leftJoin('activity a','au.a_id = a.id')
            ->leftJoin('user u','u.id = a.u_id')
            ->field($field)
            ->where($map)
            ->page($page, $limit)
            ->order($desc)
            ->select();

        $article_list['count'] = $this->count(1);
        $article_list['my_count'] = 0;
        $chargeModel    = new ActivityCharge();
        $teamTypeModel  = new ActivityTeamType();
        $charge         = $chargeModel->where(['status'=>1])->select();
        $teamType       = $teamTypeModel->where(['status'=>1])->select();

        //数据处理
        foreach ($article_list['data'] as $k=> &$v){
            $v['myCreate'] = false;
            if($v['u_id'] == $map['au.u_id']){
                $v['myCreate'] = true;
                $article_list['my_count']++;
            }
            foreach ( $charge as $chargeK =>$chargeV){
                if($chargeV['id'] == $v['charge_type']){
                    $v['charge_type_name'] = $chargeV['name'];
                }
            }
            foreach ( $teamType as $teamTypeK =>$teamTypeV){
                if($teamTypeV['id'] == $v['team_type']){
                    $v['team_type_name'] = $teamTypeV['name'];
                }
            }

            $v['imgs_url']          =  json_decode($v['imgs_url'],true);
            $v['distance']          =  $v['distance']/1000 > 1 ?round($v['distance']/1000,2).'km' : $v['distance'].'m';
            $v['create_time_name']  =  Helper::secsToStr($v['create_time']);
            $v['user_list']         = Db::name('activity_user')->alias('au')->field('u.profile')->join('user u','u.id = au.u_id')->where(['au.a_id'=>$v['id']])->select();
            $v['apply_count']       = Db::name('activity_user')->alias('au')->field('u.profile')->join('user u','u.id = au.u_id')->where(['au.a_id'=>$v['id'],'au.status'=>1])->count();
        }

        return $article_list;

    }
}