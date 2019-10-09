<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/28
 * Time: 14:15
 */

namespace app\common\model;

use think\Model;

class Team extends Model
{

    /**
     * 接口修改或创建活动
     * @param $params
     * @return Activity|int|string
     */
    public function formByApi( $params ){
        if( isset( $params['id'] ) ){
            $id = $params['id'];
            unset($params['id']);
            $row = $this->allowField(true )->where(['id'=>$id])->update($params);
        }else{
            $row = $this->insertGetId($params);
        }

        return $row;
    }

    /**
     * 查询队伍成员列表
     * @param array $map      查询条件
     * @param int $page       页码
     * @param int $limit      每页数量
     * @param string $limit   排序
     * @return array|mixed|\PDOStatement|string|\think\Collection
     */
    public function selectUserListByApi( $field='' ,$map=[],$page=1,$limit=30, $desc = 'tu.id desc' ){
        $row = $this->field($field)
            ->alias('t')
            ->leftJoin('team_user_list tu', 'tu.t_id = t.id')
            ->leftJoin('user u','u.id = tu.u_id')
            ->where($map)
            ->page($page, $limit)
            ->order($desc)
            ->select();
        foreach ($row as $k=>&$v){
            $v['create_time'] = date('Y-m-d',$v['create_time']);
        }

        return $row;

    }
}