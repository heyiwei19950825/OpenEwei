<?php
/**----------------------------------------------------------------------
 * OpenEwei V1
 * Copyright 2018-2018 http://www.redkylin.con All rights reserved.
 * ----------------------------------------------------------------------
 * Author: ewei(lamp_heyiwei@163.com)
 * Date: 2018/12/19
 * Time: 11:54
 * ----------------------------------------------------------------------
 */

namespace app\api\controller;

use QL\QueryList;
use think\Controller;

class Collect extends Controller
{

    /**
     * @param string $url    采集地址
     * @param array $rules   采集规则
     * @param string $table  插入表
     */

    public function getContent( $url = '', $rules = [],$table=""){
        // 定义采集规则
        $rules = [
            // 采集文章标题
            'title' => ['h1','text'],
            // 采集文章作者
            'author' => ['#author_baidu>strong','text'],
            // 采集文章内容
            'content' => ['.post_content','html']
        ];

        $rt = QueryList::get($url)->rules($rules)->query()->getData();

        return $this->success('采集成功');
    }
}