<?php /*a:1:{s:64:"D:\work\OpenEwei\application\admin\view\action\action_limit.html";i:1544111275;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>行为限制</title>
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/oc.css" media="all">
</head>
<body>
<div class="layui-fluid">
    <div class="layui-tab layui-tab-card">
        <ul class="layui-tab-title">
            <li class="layui-this">行为限制</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-form layui-card-header layuiadmin-card-header-auto">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">关键字</label>
                        <div class="layui-input-block">
                            <input type="text" name="keyword" placeholder="请输入标题" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">状态</label>
                        <div class="layui-input-block">
                            <select name="state">
                                <option value="0">选择状态</option>
                                <option value="1">未激活</option>
                                <option value="2">已激活</option>
                            </select>
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
                    <button class="layui-btn layuiadmin-btn-admin" data-type="add" data-title="添加" data-url="<?php echo url('admin/action/actionLimitForm'); ?>" data-width="600px" data-height="500px">添加</button>
                    <button class="layui-btn layuiadmin-btn-admin layui-btn-danger" data-type="del" data-url="<?php echo url('admin/action/delActionLimit'); ?>">删除</button>
                </div>
                <table id="list" lay-filter="list"></table>
                <script type="text/html" id="barDemo">
                    <a class="layui-btn layui-btn-xs" lay-event="other" data-title="编辑用户" data-url="<?php echo url('admin/action/actionLimitForm'); ?>" data-width="600px" data-height="500px;">编辑</a>
                    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"  data-url='<?php echo url("admin/action/delActionLimit"); ?>'>删除</a>
                </script>
            </div>
            <div class="layui-tab-item">
                <table id="data-list" lay-filter="list"></table>
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
        var table = layui.table,
            $ = layui.$;
        table.render({
            elem: '#list',
            url: "<?php echo url('admin/action/actionLimit'); ?>", //数据接口
            title: '用户权限表',
            toolbar: 'true',
            defaultToolbar: ['filter', 'print', 'exports'],
            page: true,
            loading: true,
            limit: 20,
            limits: [10, 20, 50, 100],
            cols: [[
                {type: 'checkbox', fixed: 'left'},
                {field: 'id', title: 'ID', sort: true, fixed: 'left'},
                {field: 'title', title: '标题', sort: true},
                {field: 'rule_title', title: '权限节点名称', sort: true},
                {field: 'frequency', title: '频率', sort: true},
                {field: 'punish_type', title: '处罚方式', sort: true},
                {field: 'if_message', title: '是否发送提示信息', sort: true},
                {field: 'message_content', title: '消息提示内容', sort: true},
                {field: 'create_time', title: '创建时间', sort: true},
                {field: 'update_time', title: '更新时间', sort: true},
                {field: 'status', title: '状态', sort: true},
                {fixed: 'right', width: 165, align: 'center', toolbar: '#barDemo'}
            ]],
        });
    });
</script>
</body>
</html>