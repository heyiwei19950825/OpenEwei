<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/28
 * Time: 14:45
 */

namespace app\common\model;


use think\Model;

class TeamUserList extends Model
{
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';


    /**
     * 接口查询数据数据查询
     * @param array $map      查询条件
     * @param int $page       页码
     * @param int $limit      每页数量
     * @param string $limit      拍讯
     * @return array|mixed|\PDOStatement|string|\think\Collection
     */
    public function selectTeamListByApi( $field='' ,$map=[],$page=1,$limit=10, $desc = 'id desc' ){
        $row = $this->field($field)
            ->alias('u')
            ->join('team t','t.id = u.t_id')
            ->where($map)
            ->page($page, $limit)
            ->order($desc)
            ->select();


        return $row;

    }



}