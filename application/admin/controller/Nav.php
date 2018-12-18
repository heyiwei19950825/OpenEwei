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
use org\Helper;

class Nav extends Base
{
    protected $nav;
    protected $navCategory;

    public function initialize()
    {
        //请求参数过滤【剥去字符串中的 HTML、XML 以及 PHP 的标签。】
        $this->request->filter(['strip_tags']);

        //实例化model层
        $this->nav          = model('Nav');
        $this->navCategory  = model('NavCategory');
    }

    /**
     * 菜单管理
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
                $category_children_ids = $this->navCategory->where(['path' => ['like', "%,{$cid},%"]])->column('id');
                $category_children_ids = (!empty($category_children_ids) && is_array($category_children_ids)) ? implode(',', $category_children_ids) . ',' . $cid : $cid;
                $map['cid']            = ['IN', $category_children_ids];
            }

            //查询字段
            $field = 'id,nav_id,parent_id,status,sort,name,target,href,icon,path';

            //查询数据
            $row  =  $this->nav->select( $field,$map,$page,$limit );

            //记录日志
            AdminLog::setTitle( '获取菜单列表' );

            //返回数据
            Helper::json_success( $row['data'],$row['count'] );
        }
        return $this->fetch();
    }

    /**
     * 菜单表单
     * @return mixed
     */
    public function form(){

        if ($this->request->isPost()) {
            //查询条件
            $map  = $this->request->post();

            //自动验证
            $validate = validate('Nav');

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
                $row = $this->nav->allowField(true)->save( $map );
            }else{
                $row =$this->nav->allowField(true)->update( $map );
            }

            //记录日志
            AdminLog::setTitle($map['id'] ? '编辑' : '新增'.'菜单');

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
            $data = $this->nav->find($id);
        }

        //返回数据
        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 菜单删除
     * @return mixed
     */
    public function del()
    {
        //软删除
        $aId = input('post.id', '', 'strval');
        $this->nav->where('id', 'in', $aId)->update(['status' => -1]);
        $pos = $this->nav->where('id', 'in', $aId)->select();

        foreach ($pos as $val) {
            cache('nav_pos_by_pos_' . $val['path'] . $val['name'], null);
        }

        AdminLog::setTitle('删除菜单');
    }

    /**
     * 菜单分类
     * @return mixed|\think\response\Json
     */
    public function category(){

        if($this->request->isAjax()){
            $category_list  =  $this->navCategory->select();

            AdminLog::setTitle('获取菜单列表');

            //返回数据
            Helper::json_success( $category_list );
        }
    }

    /**
     * 菜单分类表单
     * @return mixed
     */
    public function categoryForm(){

        if($this->request->isAjax()){
            $data = input('');


            if ( isset( $data['id'] )&&!empty( $data['id'] ) ) {
                $rs = $this->navCategory->update($data);
            } else {
                $rs = $this->navCategory->save($data);
            }

            if ( $rs ) {
                $this->success(isset($data['id']) ? '编辑成功' : '新增成功');
            } else {

                AdminLog::setTitle('编辑菜单分类');

                $this->error(isset($data['id']) ? '编辑失败' : '新增失败');
            }
        }

        $id     = input('get.id', 0, 'intval');
        $data = NULL;

        if( $id ){
            $data = $this->navCategory->find($id);
        }

        $this->assign('data', $data);

        return $this->fetch();
    }

    /**
     * 菜单分类删除
     */
    public function categoryDel(){
        $ids       = $this->request->post('id');

        $category = $this->navCategory->where('pid' ,'in',$ids)->find();
        $nav  = $this->nav->where('cid' ,'in',$ids)->find();

        if (!empty($category)) {
            $this->error('此菜单分类下存在子菜单分类，不可删除');
        }
        if (!empty($nav)) {
            $this->error('此菜单分类下存在菜单，不可删除');
        }
        if ($this->navCategory->destroy($ids)) {
            AdminLog::setTitle('删除菜单菜单分类');

            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
}