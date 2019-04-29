<?php

namespace app\admin\controller;

use app\admin\lib\CollectLib;
use org\Helper;
use QL\QueryList;
use think\Cache;
use think\Controller;
use think\Db;
use think\Exception;

class Collect extends Controller
{
    public $config;

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->config = model('admin/Config');
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 抓取规则
     */
    public function rule(){
        //判断请求
        if($this->request->isPost()){
            //初始化数据
            $rule       = [];
            $params     = $this->request->param();//获取请求参数
            $cacheKey   = md5(json_encode($params));//获取缓存名称

            //验证缓存是否已经完成
            if( !cache($cacheKey) ){
                //拆分出可使用规则
                $lib    = new CollectLib();
                $rule   = $lib->disposeParams($params);
            }

            dump($rule);die;


            $key = [];
            $domain = 'http://'.explode('/',$params['url'])[2];//获取域名
            $startUrl = $url;
            $url_arr = explode("\n",trim($url) );

























































//            if( !cache($cacheName) ){
                //判断抓取模式
                if( $get_model ===  "0" ){      //普通模式
                    $rule = [];
                    //需要做数据转换
                    foreach ($list_name as $k => $v){
                        foreach( $v as $sK => $sV){
                            if( empty( $sV ) || empty( $list_rule[$k][$sK] )  || empty( $list_type[$k][$sK] ) || empty( $list_desc[$k][$sK] ) ){
                                $this->error('列表规则参数不能为空');
                            }
                            $rule[$k][$sV] = [$list_rule[$k][$sK],$list_type[$k][$sK],$list_desc[$k][$sK]];
                        }
                    }
                }else{
                    //数据验证
                    try{
                        $rule = json_decode($params['rule'],true);
                    }catch (Exception $e){
                        $this->error('规则格式错误');
                    }
                }

                if(empty($rule)) $this->error('列表规则参数不能为空或错误');

                //固定json返回key
                $key[]  = ['type'  => 'checkbox','fixed' => 'left',];
                //初始化抓取所有字段的key值 并 清洗爬取规则
                foreach ($rule as $ruleK => &$ruleV){
                    foreach ($ruleV as $keyK => &$keyV ){
                        $key[] = [
                            'field' => $keyK,
                            'title' => $keyV[2]
                        ];
                        unset($keyV[2]);
                    }
                }

                //固定json返回key
                $key[] =["fixed"=> 'right', "width"=> 165, "align"=> 'center', "toolbar"=> '#barDemo'];

                $cacheVal = array(
                    'url'           => $url,            //爬取开始页url
                    'page'          => $page,           //爬取页数
                    'start_page'    => $start_page,     //爬取开始页
                    'key'           => $key,            //页面显示key表示
                    'range'         => $range,          //爬取规则切片
                    'rule'          => $rule,           //爬取规则
                    'make'          => $make,           //二级抓取标示
                );
                //存储爬取规则
                cache($cacheName,$cacheVal,3600);
//            }

            //分解爬取规则
            $cacheVal = cache($cacheName);
            extract($cacheVal);


            reset($range);
            $first_key = key($range);

            $url = str_replace('@@',$start_page[$first_key],$startUrl);
            try{
                $data = QueryList::get($url)->rules($rule[$first_key])->range($range[$first_key])->query()->getData()->all();
                foreach ( $data as $dataK => $dataV){

                    //删除空白数据
                    $noEmpty = false;
                    foreach ($dataV as $dataVK=>$dataVV){
                        if( !empty( $dataVV) ){
                            $noEmpty = true;
                        }
                    }
                    if(!$noEmpty) unset($data[$dataK]);
                }
                $startPage = ($start_page[$first_key] += 1);
            }catch (Exception $e){
                return $this->error('采集规则错误，请检查');
            }
            $row = array_merge($row, $data);

            //当前阶段数据抓取完成
            if( ( $startPage - 1 ) == $page[$first_key]){
                unset($start_page[$first_key]);
                unset($page[$first_key]);
                unset($range[$first_key]);
                unset($rule[$first_key]);
                unset($make[$first_key]);
                //判断二级标示不为空时 说明还有下一级数据
                if( !empty($make) && !empty($data)){
                    reset($make);
                    $make_key = key($make);
                    $startUrl = $data[0][$make[$make_key]];
                }
            }

            if( empty($rule) ){
                cache($cacheName,NULL);
            }else{
                //存储修改后爬取规则
                cache($cacheName,array(
                    'url'           => $startUrl,       //爬取开始页url
                    'page'          => $page,           //爬取页数
                    'start_page'    => $start_page,     //爬取开始页
                    'key'           => $key,            //页面显示key表示
                    'range'         => $range,          //爬取规则切片
                    'rule'          => $rule            //爬取规则
                ),3600);
            }


            return $this->success( '第一阶段数据抓取，抓取当前第'.( $startPage - 1 ).'页','', ['key'=>$key,'data'=>$row,'']);
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
