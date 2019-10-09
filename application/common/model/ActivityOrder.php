<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/29
 * Time: 17:36
 */

namespace app\common\model;


use think\Model;

class ActivityOrder extends Model
{
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';

    /**
     * 接口获取订单数据
     */
    public function selectOrderListByApi( $field='' ,$map=[],$page=1,$limit=30, $desc = 'o.id desc'){
        $row = $this->alias('o')
            ->leftJoin('activity a','o.a_id = a.id')
            ->where($map)
            ->field($field)
            ->page($page, $limit)
            ->order($desc)
            ->select();

        foreach ($row as $k=>&$v){
            //1平台活动 2队长活动  3免费活动
            switch ($v['hold_type']){
                case 1:
                    $v['hold_type_name'] = '平台活动';
                    break;
                case 2:
                    $v['hold_type_name'] = '队长活动';
                    break;
                case 3:
                    $v['hold_type_name'] = '免费活动';
                    break;
            }
            $v['imgs_url'] = json_decode($v['imgs_url'],true);
        }

        return $row;
    }
}