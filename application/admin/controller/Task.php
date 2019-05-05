<?php

namespace app\admin\controller;

use app\admin\lib\CollectLib;
use app\admin\model\AdminLog;
use app\admin\validate\TaskRule;
use org\Helper;
use QL\QueryList;
use think\Cache;
use think\Controller;
use think\Db;
use think\Exception;
use app\admin\validate\Task as  TaskValidate;

class Task extends Controller
{
    public $config;
    public $task;

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->config   = model('admin/Config');
        $this->task     = model('admin/Task');
    }

    /**
     * 任务列表
     *
     * @return \think\Response
     */
    public function index()
    {
        if ($this->request->isAjax()) {
            $page       = input('get.page/d', 1);
            $limit      = input('get.limit/d', 20);
            $keyword    = input('get.keyword', '');
            $status     = input('get.auto', '');
            $map        = [];

            if(!empty($keyword)){
                $map[] = ['name','like','%'.$keyword.'%'];
            }

            if(!empty($status)){
                $map[] = ['status','=',$status];
            }

            $taskList = $this->task
                ->where($map)
                ->page($page, $limit)
                ->select()
                ->toArray();

            $count = $this->task->where($map)->count();
            $data = [
                'code' => 0,
                'msg' => '数据返回成功',
                'count' => $count,
                'data' => $taskList
            ];
            AdminLog::setTitle('获取任务列表');
            return json($data);
        }
        AdminLog::setTitle('任务列表');
        return $this->fetch();
    }

    /**
     * 任务添加
     */
    public function taskForm(){
        if( $this->request->isPost()){
            $data = input('');
            $title = isset($data['id']) ? '编辑' : '新增';
//            //自动验证
//            $validate = new TaskValidate();
//            if( !$validate->check($data) ){
//                $this->error( $validate->getError() );
//            }
            if ($data['id']) {
                $res = $this->task->update($data);
            } else {
                $res = $this->task->insert($data);
            }

            if ($res) {
                AdminLog::setTitle($title . '采集任务成功');
                $this->success($title . '采集任务成功',url('task/taskForm1','id='.$res));
            } else {
                AdminLog::setTitle($title . '采集任务失败');
                $this->error($title . '采集任务失败');
            }
        }else{
            $id = input('get.id/d', 0);
            $rule = $this->task->find($id);
            $this->assign('task', $rule);
            return $this->fetch();
        }
    }
    /**
     * 规则添加
     */
    public function taskForm1(){

        if( $this->request->isPost() ){
            $data = input('');

            $taskRuleValidate = new TaskRule();
            if( $taskRuleValidate->check($data) ){
                $this->error($taskRuleValidate->getError());
            }

            //拆分出可使用规则
            $lib    = new CollectLib();
            $rule   = $lib->disposeParams($data);

            if ($data['id']) {
                $res = $this->task->update($data);
            } else {
                $res = $this->task->insert($data);
            }

            if ($res) {
                AdminLog::setTitle($title . '采集任务成功');
                $this->success($title . '采集任务成功',url('task/taskForm1','id='.$res));
            } else {
                AdminLog::setTitle($title . '采集任务失败');
                $this->error($title . '采集任务失败');
            }




        }else{

            return $this->fetch();
        }
    }
    /**
     * 采集任务发布
     */
    public function taskForm2(){
        return $this->fetch();
    }


    /**
     * 抓取规则
     */
    public function rule(){
        //判断请求
        if($this->request->isPost()){
            //初始化数据
            $data     = input('');//获取请求参数

            //拆分出可使用规则
            $lib    = new CollectLib();
            $rule   = $lib->disposeParams($data);

            if( isset($rule['result'])&&!$rule['result'] ){
                $this->error($rule['msg']);
            }

            //整理采集url
            $data = [
                [
                    'url' => [],
                    'rule'=> [],
                ],
                [
                    'url' => [],
                    'rule'=> [],
                ]
            ];


        }


        return $this->fetch();
    }

    /**
     * 保存抓取规则
     */
    public function saveRule(){

    }

    /**
     * 保存数据
     */
    public function saveData(){

        if( $this->request->isPost() ){
            $params  = $this->request->param();
            $params['data']    = json_decode($params['data'],true);
            parse_str($params['config'],$config);

            //独立数据转换
            if($params['alone'] == true){
                $data = $params['data'];
            }else{
                $data = $params['data'];
            }


            if(empty($data) ){
                return $this->error('暂无数据');
            }

            //检测表是否存在
            $checkRow = Db::query('show tables like "oc_'.$config['tableName'].'"');

            //表不存在并且不创建新表 提示错误
            if( empty($checkRow) ){

                return $this->error('数据表不存在');
            }
            try{
                //创建表
                if( $config['field'] != 0 ){
                    $field = array_keys($data[0]);
                    $tableField = Db::query('desc oc_'.$config['tableName']);
                    $tableFields = [];
                    foreach($tableField as $k=>$v){
                        $tableFields[] = $v['Field'];
                    }
                    $sql = '';
                    //检测字段是否已经存在表中   如果没有则生成sql语句              //生成sql语句
                    foreach ($field as $k=>$v){
                        if(!in_array($v,$tableFields)){
                            $len = ''; // 字段类型
                            $demo  = $data[0][$v];

                            $coutLen = strlen( $demo );

                            switch ($coutLen){
                                case $coutLen < 50:
                                    $len ='varchar(50)';
                                    break;

                                case $coutLen < 255:
                                    $len ='varchar(255)';
                                    break;

                                case $coutLen > 255:
                                    $len ='text';
                                    break;
                                default:
                                    $len ='text';
                                    break;
                            }
                            $sql .= ' ADD COLUMN `'.$v.'` '.$len.' DEFAULT NULL COMMENT \'测试\', ';
                        }

                    }
                    //执行sql语句
                    $sql = 'ALTER TABLE `oc_'.$config['tableName'].'`'.rtrim($sql,', ').';';
                    Db::query($sql);
                }
                //院校库===============================
                $names = Db::name($config['tableName'])->field('name')->select();

                foreach ($names as $aa=>$bb){
                    $names[$aa] = $bb['name'];
                }
                foreach ($data as $a => $b){
                    if(in_array($b['name'],$names)){
                            unset($data[$a]);
                    }
                }
                //院校库===============================
                $insertRow = true;
                //数据写入表中
                foreach ($data as $k=>$v){
                    $rows= Db::name($config['tableName'])->insert($v);
                    if(!$rows) $insertRow = false;
                }
                if($insertRow){
                    return $this->success('写入成功');
                }

            }catch (Exception $e){
                echo $e->getMessage();die;
                return $this->error('错误数据，请检查2');

            }
        }
    }

    /**
     * 采集入库配置
     * @return mixed
     */
    public function importConfig(){
        return $this->fetch();
    }



}