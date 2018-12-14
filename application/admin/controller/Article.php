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
use app\admin\validate\ArticleCategory;
use think\Request;

class Article extends Base
{
    protected $article;
    protected $articleCategory;

    public function initialize()
    {
        $this->article          = model('Article');
        $this->articleCategory  = model('ArticleCategory');
        $request = \think\facade\Request::instance();

        if($request->action() != 'category'){
            $category_level_list = $this->articleCategory->getLevelList();
            $this->assign('category_level_list', $category_level_list);
        }

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

            if(!empty($cid)){
                $map[] = ['cid','=',$cid];
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


    public function del()
    {
        $aId = input('post.id', '', 'strval');
        $this->article->where('id', 'in', $aId)->update(['status' => -1]);
        $pos = $this->article->where('id', 'in', $aId)->select();
        foreach ($pos as $val) {
            cache('article_pos_by_pos_' . $val['path'] . $val['name'], null);
        }
        unset($val);
        AdminLog::setTitle('删除广告位');
    }

    /**
     * 分类
     * @return mixed|\think\response\Json
     */
    public function category(){

//        if($this->request->isAjax()){
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
                ->order(['sort' => 'DESC'])
                ->select();

            $count = $this->articleCategory->where($map)->count();
            if(!empty($keyword)){
                $category_level_list = $category_list;
            }else{
                $category_list = array2level($category_list);
                $category_level_list = [];
                foreach ($category_list as $k=>$v){
                    if( $v['level'] != 1 ){
                        for($i=1;$i<$v['level'];$i++){
                            $v['name'] = '|____'.$v['name'];
                        }
                    }

                    $category_level_list[] = $v;
                }
            }


            $data = [
                'code' => 0,
                'msg' => '数据返回成功',
                'count' => $count,
                'data' => $category_level_list
            ];

            AdminLog::setTitle('获取文章列表');
            return json($data);
//        }
    }

    /**
     * 分类表单
     * @return mixed
     */
    public function categoryForm(){

        if($this->request->isAjax()){
            $data = input('');

            //自动验证
            $validate = new ArticleCategory();
            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }

            if ( isset( $data['id'] )&&!empty( $data['id'] ) ) {
                $rs = $this->articleCategory->update($data);
            } else {
                $rs = $this->articleCategory->insert($data);
            }

            if ( $rs ) {
                $this->success(isset($data['id']) ? '编辑成功' : '新增成功');
            } else {

                AdminLog::setTitle('编辑分类');

                $this->error(isset($data['id']) ? '编辑失败' : '新增失败');
            }

        }
        $category = NULL;
        $this->assign('category',$category);
        return $this->fetch();
    }

    /**
     * 分类删除
     */
    public function categoryDel(){
        $ids       = $this->request->post('id');

        $category = $this->articleCategory->where('pid' ,'in',$ids)->find();
        $article  = $this->article->where('cid' ,'in',$ids)->find();

        if (!empty($category)) {
            $this->error('此分类下存在子分类，不可删除');
        }
        if (!empty($article)) {
            $this->error('此分类下存在文章，不可删除');
        }
        if ($this->articleCategory->destroy($ids)) {
            AdminLog::setTitle('删除文章分类');

            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
}