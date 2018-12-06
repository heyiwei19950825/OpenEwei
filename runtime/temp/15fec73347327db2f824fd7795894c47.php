<?php /*a:1:{s:75:"D:\work\yanglao_admin_3\application\admin\view\resthome_feedback\index.html";i:1543770197;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户反馈管理</title>
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
                        <div class="layui-block">
                            <label class="layui-form-label">时间范围</label>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" id="date-time" placeholder=" - ">
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">反馈类别</label>
                            <div class="layui-input-inline">
                                <select class="form-control m-b" name="statuss">
                                    <option value="">选择类别</option>
                                    <option value="1">机构</option>
                                    <option value="2">其他</option>
                                    <option value="3">异常</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">反馈人</label>
                            <div class="layui-input-inline">
                                <input type="text" name="keyword" value="" placeholder="请输入反馈人" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">关键字</label>
                            <div class="layui-input-inline">
                                <input type="text" name="keyword" value="" placeholder="请输入关键字" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <button class="layui-btn layuiadmin-btn-useradmin" lay-submit lay-filter="LAY-user-front-search">
                                <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="layui-tab-item layui-show">
                    <div style="padding: 10px;">
                        <button class="layui-btn layuiadmin-btn-admin layui-btn-danger" data-type="del" data-url="<?php echo url('del'); ?>">删除</button>
                    </div>
                    <table id="list" lay-filter="list"></table>
                    <script type="text/html" id="barDemo">
                        <a class="layui-btn layui-btn-xs" lay-event="other" data-title="修改状态" data-url="<?php echo url('update_status'); ?>" data-width="500px" data-height="50%">修改状态</a>
                        <a class="layui-btn layui-btn-xs" lay-event="other" data-title="回复" data-url="<?php echo url('reply'); ?>" data-width="500px" data-height="50%">回复</a>
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
    }).use(['table', 'jquery','laydate','common'],function(){
        var table = layui.table;
        table.render({
            elem: '#list',
            url: "<?php echo url('ResthomeFeedback/index'); ?>", //数据接口
            title: '用户反馈表',
            toolbar: 'true',
            defaultToolbar: ['filter', 'print', 'exports'],
            page: true,
            loading: true,
            limit: 20,
            limits: [10, 20, 50, 100],
            cols: [[
                {type: 'checkbox', fixed: 'left'},
                {field: 'id', title: 'ID', sort: true, fixed: 'left'},
                {field: 'resthome_name', title: '反馈内容', sort: true},
                {field: 'resthome_short', title: '反馈类型', sort: true},
                {field: 'resthome_slogen', title: '描述', sort: true},
                {field: 'resthome_hits', title: '反馈状态', sort: true},
                {field: 'resthome_hits', title: '反馈备注', sort: true},
                {fixed: 'right', title: '操作',width: 175, align: 'center', toolbar: '#barDemo'}
            ]]
        });
    });
</script>
</body>
</html>