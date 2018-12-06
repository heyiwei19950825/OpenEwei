<?php /*a:1:{s:62:"D:\work\yanglao_admin_3\application\admin\view\book\index.html";i:1543769893;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>预约管理</title>
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/oc.css" media="all">
</head>
<body>
<div class="layui-fluid">
    <div class="layui-tab layui-tab-card">
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div class="layui-form layui-card-header layuiadmin-card-header-auto">
                    <div class="layui-form-item">
                        <label class="layui-form-label">所在地</label>
                        <div class="layui-input-inline">
                            <select name="province" lay-search="" id="province" lay-filter="province">
                                <option value="">请选择省</option>
                                <?php if(is_array($chinacity['province']) || $chinacity['province'] instanceof \think\Collection || $chinacity['province'] instanceof \think\Paginator): if( count($chinacity['province'])==0 ) : echo "" ;else: foreach($chinacity['province'] as $key=>$vo): ?>
                                <option value="<?php echo htmlentities($vo['id']); ?>" ><?php echo htmlentities($vo['name']); ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                        <div class="layui-input-inline">
                            <select name="city" lay-search="" id="city" lay-filter="city">
                                <option value="">请选择市</option>
                                <?php if(is_array($chinacity['city']) || $chinacity['city'] instanceof \think\Collection || $chinacity['city'] instanceof \think\Paginator): if( count($chinacity['city'])==0 ) : echo "" ;else: foreach($chinacity['city'] as $key=>$vo): ?>
                                <option value="<?php echo htmlentities($vo['id']); ?>" ><?php echo htmlentities($vo['name']); ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                        <div class="layui-input-inline">
                            <select name="district" lay-search="" id="district" lay-filter="district">
                                <option value="">请选择县/区</option>
                                <?php if(is_array($chinacity['district']) || $chinacity['district'] instanceof \think\Collection || $chinacity['district'] instanceof \think\Paginator): if( count($chinacity['district'])==0 ) : echo "" ;else: foreach($chinacity['district'] as $key=>$vo): ?>
                                <option value="<?php echo htmlentities($vo['id']); ?>" ><?php echo htmlentities($vo['name']); ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">

                        <div class="layui-inline">
                            <label class="layui-form-label">请选择范围</label>
                            <div class="layui-input-inline" style="width: 500px;">
                                <input type="text" class="layui-input" id="date-time" name="time-scope" placeholder="开始 到 结束">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">预约状态</label>
                            <div class="layui-input-inline">
                                <select class="form-control m-b" name="statuss">
                                    <option value="">选择状态</option>
                                    <option value="1">已联系</option>
                                    <option value="2">未联系</option>
                                    <option value="3">超时</option>
                                    <option value="4">取消</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">关键字</label>
                            <div class="layui-input-inline">
                                <input type="text" name="keyword" value="" placeholder="请输入关键字" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <button class="layui-btn layuiadmin-btn-useradmin" lay-submit lay-filter="LAY-search">
                                <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="layui-tab-item layui-show">
                    <div style="padding: 10px;">
                        <button class="layui-btn layuiadmin-btn-admin" data-type="add" data-title="添加预约信息" data-url="<?php echo url('form'); ?>" data-width="90%" data-height="90%">添加</button>
                        <button class="layui-btn layuiadmin-btn-admin layui-btn-danger" data-type="del" data-url="<?php echo url('del'); ?>">删除</button>
                    </div>
                    <table id="list" lay-filter="list"></table>
                    <script type="text/html" id="barDemo">
                        <a class="layui-btn layui-btn-xs" lay-event="other" data-title="修改状态" data-url="<?php echo url('update_status'); ?>" data-width="500px" data-height="50%">修改状态</a>
                        <a class="layui-btn layui-btn-xs" lay-event="other" data-title="编辑预约" data-url="<?php echo url('form'); ?>" data-width="90%" data-height="90%">编辑</a>
                        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"  data-url="<?php echo url('del'); ?>">删除</a>
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/static/layuiadmin/layui/layui.js"></script>
<script>
    layui.config({
        base: '/static/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['table', 'jquery','laydate','common','form'],function(){
        var table = layui.table,
            form = layui.form,
            $ = layui.$;
        table.render({
            elem: '#list',
            url: "<?php echo url('book/index'); ?>", //数据接口
            title: '预约表',
            toolbar: 'true',
            defaultToolbar: ['filter', 'print', 'exports'],
            page: true,
            loading: true,
            limit: 20,
            limits: [10, 20, 50, 100],
            cols: [[
                {type: 'checkbox', fixed: 'left'},
                {field: 'id', title: 'ID', sort: true, fixed: 'left'},
                {field: 'user_name', title: '客户姓名', sort: true},
                {field: 'user_kindred', title: '与入驻人关系', sort: true},
                {field: 'user_phone', title: '联系方式', sort: true},
                {field: 'resthome_name', title: '预约名称', sort: true},
                {field: 'resthome_contact', title: '预约联系人', sort: true},
                {field: 'resthome_phone', title: '预约联系人电话', sort: true},
                {field: 'service_phase', title: '预约阶段', sort: true},
                {field: 'service_status', title: '预约状态', sort: true},
                {field: 'service_fristname', title: '首次服务人', sort: true},
                {field: 'service_remarke', title: '备注', sort: true},
                {fixed: 'right', title: '操作',width: 175, align: 'center', toolbar: '#barDemo'}
            ]]
        });

        //城市三级联动
        initSelect('province',0);
        //初始化下拉框
        function initSelect(id,param){
            $.post("<?php echo url('common/getCity'); ?>",{
                id:param
            },function(result){
                var data = result.data;
                var arr = [];
                arr.push("<option value=''>请选择</option>");
                $.each(data, function(i,item){
                    var t = item.name, v = item.id, option = "<option value='"+v+"'>"+t+"</option>";
                    arr.push(option);
                })

                $("#"+id).empty();
                $("#"+id).append(arr.join(""));
                form.render('select');
            },'json')
        }

        form.on('select(province)',function(data){
            initSelect('city',data.value);
        })
        form.on('select(city)',function(data){
            initSelect('district',data.value);
        })
    });
</script>
</body>
</html>