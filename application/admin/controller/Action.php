<?php
/**----------------------------------------------------------------------
 * EweiAdmin V3
 * Copyright 2014-2018 http://www.redkylin.com All rights reserved.
 * ----------------------------------------------------------------------
 * Author: ewei(ewei@dtyjkj.com)
 * Date: 2018/10/12
 * Time: 10:05
 * ----------------------------------------------------------------------
 */

namespace app\admin\controller;

use app\admin\validate\ActionLimit;
use app\admin\model\AdminLog;

class Action extends Base
{
    protected $actionLimit;
    protected $userRule;

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->actionLimit = model('admin/ActionLimit');
        $this->userRule = model('admin/UserRule');
    }

    /**
     * 用户行为限制列表
     * @return mixed|\think\response\Json
     * @author:wdx(wdx@ourstu.com)
     */
    public function actionLimit()
    {
        if ($this->request->isAjax()) {
            $page = input('get.page/d', 1);
            $limit = input('get.limit/d', 20);
            $map[] = ['status', '>=', 0];
            //用户行为限制列表
            $actionLimitList = $this->actionLimit->getList($map, $page, $limit);
            //处罚类型
            $punishType = config('app.user_action_punish_type');
            //时间单位
            $timeUnit = config('app.time_unit');
            //权限节点
            $rule = $this->userRule->where('status', '>=', 1)->column('title', 'id');
            foreach ($actionLimitList as $key => &$val) {
                $punish = explode(',', $val['punish_type']);
                foreach ($punish as $k => $v) {
                    $punish[$k] = $punishType[$v];
                }
                unset($k, $v);
                $val['punish_type'] = implode(',', $punish);
                to_status($val);
                $val['frequency'] = $val['frequency'] . '次/' . $val['time_number'] . $timeUnit[$val['time_unit']];
                to_yes_no($val, 'if_message');
                $val['rule_title'] = $rule[$val['rule_id']];
            }
            unset($key, $val);
            $count = $this->actionLimit->where($map)->count();
            $data = [
                'code' => 0,
                'msg' => '数据返回成功',
                'count' => $count,
                'data' => $actionLimitList
            ];
            AdminLog::setTitle('获取用户行为限制列表');
            return json($data);
        }
        AdminLog::setTitle('用户行为限制列表');
        return $this->fetch();
    }

    /**
     * 用户行为表单
     * @return mixed
     * @author:wdx(wdx@ourstu.com)
     */
    public function actionLimitForm()
    {
        if ($this->request->isPost()) {
            $data = input('post.', []);
            $title = $data['id'] ? '编辑' : '新增';
            $data['status'] = isset($data['status']) ? 1 : 0;
            //自动验证
            $validate = new ActionLimit();
            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }
            if ($data['id']) {
                $res = $this->actionLimit->update($data);
            } else {
                $data['create_time'] = time();
                $res = $this->actionLimit->insert($data);
            }
            if ($res) {
                AdminLog::setTitle($title . '行为限制');
                $this->success($title . '行为限制成功');
            } else {
                $this->error($title . '行为限制失败');
            }
        } else {
            $id = input('get.id/d', 0);
            $actionLimit = $this->actionLimit->find($id);
            //时间单位
            $timeUnit = config('app.time_unit');
            //处罚类型
            $punishType = config('app.user_action_punish_type');
            //用户权限树
            $userRuleTree = $this->userRule->getTree('id, pid, title');
            $this->assign('actionLimit', $actionLimit);
            $this->assign('timeUnit', $timeUnit);
            $this->assign('punishType', $punishType);
            $this->assign('userRuleTree', $userRuleTree);
            return $this->fetch();
        }
    }

    /**
     * 删除用户行为限制
     * @author:wdx(wdx@ourstu.com)
     */
    public function delActionLimit()
    {
        $ids = array_unique(input('post.id/a', []));
        $rs = $this->actionLimit->whereIn('id', $ids)->setField('status', '-1');
        if ($rs) {
            AdminLog::setTitle('删除用户行为限制');
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
}