<?php
/**----------------------------------------------------------------------
 * OpenEwei V3
 * Copyright 2014-2018 http://www.redkylin.com All rights reserved.
 * ----------------------------------------------------------------------
 * Author: ewei(ewei@dtyjkj.com)
 * Date: 2018/9/12
 * Time: 16:05
 * ----------------------------------------------------------------------
 */
namespace app\common\model;

use think\Model;
use think\Session;

class Nav extends Model
{

    //自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }

    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';

    /**
     * 分类表关联
     * @return \think\model\relation\HasOne
     */
    protected function articleCategory(){
        return $this->hasOne('ArticleCategory')->field('title as c_title');
    }

    /**
     * 文章作者
     * @param $value
     * @return mixed
     */
    protected function setAuthorAttr($value)
    {
        return $value ? $value : session('admin_auth')['username'];
    }

    /**
     * 反转义HTML实体标签
     * @param $value
     * @return string
     */
    protected function setContentAttr($value)
    {
        return htmlspecialchars_decode($value);
    }

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
     * @param string $field   过滤字段
     * @param array $map      查询条件
     * @param int $page       页码
     * @param int $limit      每页数量
     * @return array|mixed|\PDOStatement|string|\think\Collection
     */
    public function select( $field='',$map=[],$page=1,$limit=30 ){

        $article_list['data'] = $this->field($field)
            ->where($map)
            ->page($page, $limit)
            ->select();

        $article_list['count'] = $this->count(1);


        return $article_list;

    }
}