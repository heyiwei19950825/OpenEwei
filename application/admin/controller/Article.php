<?php
/**----------------------------------------------------------------------
 * OpenCenter V3
 * Copyright 2014-2018 http://www.ocenter.cn All rights reserved.
 * ----------------------------------------------------------------------
 * Author: lin(lt@ourstu.com)
 * Date: 2018/9/13
 * Time: 14:23
 * ----------------------------------------------------------------------
 */

namespace app\admin\controller;

use app\admin\model\AdminLog;
use think\Exception;

class Article extends Base
{
    protected $article;
    protected $articleCategory;

    public function initialize()
    {
        $this->article          = model('Article');
        $this->articleCategory  = model('ArticleCategory');
    }

    /**
     * 文章管理

     * @return mixed
     */
    public function index(){
        if($this->request->isAjax()){
            $page       = input('get.page/d', 1);
            $limit      = input('get.limit/d', 20);
            $cid        = input('get.cid/d', 0);
            $keyword    = input('get.keyword', '');
            $status     = input('get.status', '');
            $map        = [];

            if(!empty($keyword)){
                $map[] = ['title|author','like','%'.$keyword.'%'];
            }

            if(!empty($status)){
                $map[] = ['status','=',$status];
            }

            $field = 'id,title,cid,author,reading,status,publish_time,sort,reading,is_top,is_recommend,publish_time,create_time';

            if ($cid > 0) {
                $category_children_ids = $this->articleCategory->where(['path' => ['like', "%,{$cid},%"]])->column('id');
                $category_children_ids = (!empty($category_children_ids) && is_array($category_children_ids)) ? implode(',', $category_children_ids) . ',' . $cid : $cid;
                $map['cid']            = ['IN', $category_children_ids];
            }

            if (!empty($keyword)) {
                $map['title'] = ['like', "%{$keyword}%"];
            }
            $article_list  =  $this->article
                ->field($field)
                ->where($map)
                ->page($page, $limit)
                ->select()
                ->toArray();
            $count = $this->article->where($map)->count();

            $data = [
                'code' => 0,
                'msg' => '数据返回成功',
                'count' => $count,
                'data' => $article_list
            ];

            AdminLog::setTitle('获取文章列表');
            return json($data);

        }

        $category_list = $this->articleCategory->column('name', 'id');
        $this->assign('category_list',$category_list);

        return $this->fetch();
    }

    public function from(){

    }

    public function category(){
        if($this->request->isAjax()){
            $map = [];
            $page       = input('get.page/d', 1);
            $limit      = input('get.limit/d', 20);
            $keyword    = input('get.keyword', '');
            $status     = input('get.status', '');

            if(!empty($keyword)){
                $map[] = ['name','like','%'.$keyword.'%'];
            }

            if(!empty($status)){
                $map[] = ['status','=',$status];
            }

            $category_list  =  $this->articleCategory
                ->where($map)
                ->page($page, $limit)
                ->select()
                ->toArray();
            $count = $this->articleCategory->where($map)->count();

            $data = [
                'code' => 0,
                'msg' => '数据返回成功',
                'count' => $count,
                'data' => $category_list
            ];

            AdminLog::setTitle('获取文章列表');
            return json($data);
        }

        $category_list = $this->articleCategory->column('name', 'id');
        $this->assign('category_list',$category_list);

        return $this->fetch();
    }

    public function category_from(){

    }


    public function update_status(){

    }
}