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

class ArticleCategory extends Model
{
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';

    protected static function init()
    {
        parent::init();

        self::event('after_insert', function ($category) {
            $pid = $category->pid;
            if ($pid > 0) {
                $parent         = self::get($pid);
                $category->path = $parent->path . $pid . ',';
            } else {
                $category->path = 0 . ',';
            }

            $category->save();
        });

        self::event('after_update', function ($category) {
            $id   = $category->id;
            $pid  = $category->pid;
            $data = [];

            if ($pid == 0) {
                $data['path'] = 0 . ',';
            } else {
                $parent       = self::get($pid);
                $data['path'] = $parent->path . $pid . ',';
            }

            if ($category->where('id', $id)->update($data) !== false) {
                $children = self::all(['path' => ['like', "%{$id},%"]]);
                foreach ($children as $value) {
                    $value->path = $data['path'] . $id . ',';
                    $value->save();
                }
            }
        });
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
     * 反转义HTML实体标签
     * @param $value
     * @return string
     */
    protected function setContentAttr($value)
    {
        return htmlspecialchars_decode($value);
    }

    /**
     * 自动生成时间
     * @return bool|string
     */
    protected function setCreateTimeAttr()
    {
        return date('Y-m-d H:i:s');
    }

    /**
     * 获取层级缩进列表数据
     * @return array
     */
    public function getLevelList()
    {
        $category_level = $this->order(['sort' => 'DESC'])->select();

        return array2level($category_level);
    }
}