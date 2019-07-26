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

namespace app\admin\controller;

use app\admin\model\AdminLog;
use org\Helper;

class Article extends Base
{
    protected $article;
    protected $articleCategory;

    public function initialize()
    {
        //请求参数过滤【剥去字符串中的 HTML、XML 以及 PHP 的标签。】
        $this->request->filter(['strip_tags']);

        //实例化model层
        $this->article          = model('Article');
        $this->articleCategory  = model('ArticleCategory');

        $category_level_list = $this->articleCategory->getLevelList();
        $this->assign('category_level_list', $category_level_list);

    }

    /**
     * 文章管理
     * @return mixed
     */
    public function index(){
        if($this->request->isAjax()){
            //查询条件
            $page       = input('get.page/d', 1);
            $limit      = input('get.limit/d', 20);
            $cid        = input('get.cid/d', 0);
            $keyword    = input('get.keyword', '');
            $status     = input('get.status', '');
            $map        = [];

            //条件判断
            if(!empty($keyword)){
                $map[] = ['title|author','like','%'.$keyword.'%'];
            }

            if(!empty($status)){
                $map[] = ['status','=',$status];
            }

            if(!empty($cid)){
                $map[] = ['cid','=',$cid];
            }

            if ($cid > 0) {
                $category_children_ids = $this->articleCategory->where(['path' => ['like', "%,{$cid},%"]])->column('id');
                $category_children_ids = (!empty($category_children_ids) && is_array($category_children_ids)) ? implode(',', $category_children_ids) . ',' . $cid : $cid;
                $map['cid']            = ['IN', $category_children_ids];
            }

            //查询字段
            $field = 'id,title,cid,author,reading,status,publish_time,sort,reading,is_top,is_recommend,publish_time,create_time';

            //查询数据
            $row  =  $this->article->select( $field,$map,$page,$limit );

            //记录日志
            AdminLog::setTitle( '获取文章列表' );

            //返回数据
            Helper::json_success( $row['data'],$row['count'] );
        }

        return $this->fetch();
    }

    /**
     * 文章表单
     * @return mixed
     */
    public function form(){

        if ($this->request->isPost()) {

            //查询条件
            $map  = $this->request->post();
            //自动验证
            $validate = validate('Article');

            if (!$validate->check($map)) {
                $this->error($validate->getError());
            }

            //优化参数
            if(!isset($map['thumb'])){
                $map['thumb'] = '';
            }
            if(!isset($map['photo'])){
                $map['photo'] = '';
            }
            $map['publish_time'] = strtotime($map['publish_time']);
            unset($map['file']);

            //数据库操作
            if( empty($map['id']) ){
                $row = $this->article->allowField(true)->save( $map );
            }else{
                $row =$this->article->allowField(true)->update( $map );
            }

            //记录日志
            AdminLog::setTitle($map['id'] ? '编辑' : '新增'.'文章');

            //查询结果判断
            if ($row) {
                $this->success($map['id'] ? '编辑成功' : '新增成功');
            } else {
                $this->error($map['id'] ? '编辑失败' : '新增失败');
            }
        }

        //获取查询条件
        $id     = input('get.id', 0, 'intval');
        $data = NULL;

        //判断查询
        if( $id ){
            $data = $this->article->find($id);
        }

        //返回数据
        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 文章删除
     * @return mixed
     */
    public function del()
    {
        //软删除
        $aId = input('post.id', '', 'strval');
        $this->article->where('id', 'in', $aId)->update(['status' => -1]);
        $pos = $this->article->where('id', 'in', $aId)->select();

        foreach ($pos as $val) {
            cache('article_pos_by_pos_' . $val['path'] . $val['name'], null);
        }

        AdminLog::setTitle('删除文章');
    }

    /**
     * 分类
     * @return mixed|\think\response\Json
     */
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


            AdminLog::setTitle('获取文章列表');

            Helper::json_success( $category_level_list, $count );
        }
    }

    /**
     * 分类表单
     * @return mixed
     */
    public function categoryForm(){

        if($this->request->isAjax()){
            $data = input('');

            //自动验证
            $validate = validate('ArticleCategory');
            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }

            if(!isset($map['thumb'])){
                $map['thumb'] = '';
            }

            if ( isset( $data['id'] )&&!empty( $data['id'] ) ) {
                $rs = $this->articleCategory->update($data);
            } else {
                $rs = $this->articleCategory->save($data);
            }

            if ( $rs ) {
                $this->success(isset($data['id']) ? '编辑成功' : '新增成功');
            } else {

                AdminLog::setTitle('编辑分类');

                $this->error(isset($data['id']) ? '编辑失败' : '新增失败');
            }

        }

        $id     = input('get.id', 0, 'intval');
        $data = NULL;

        if( $id ){
            $data = $this->articleCategory->find($id);
        }

        $this->assign('data', $data);

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