<?php /*a:1:{s:65:"D:\work\yanglao_admin_3\application\admin\view\user\old_user.html";i:1543420949;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户管理</title>
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/oc.css" media="all">
</head>
<body>
<div class="layui-fluid">
    <div class="layui-tab layui-tab-card">
        <ul class="layui-tab-title">
            <li class="layui-this">用户管理</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-form layui-card-header layuiadmin-card-header-auto">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">请选择范围</label>
                        <div class="layui-input-inline" style="width: 500px;">
                            <input type="text" class="layui-input" id="date-time" name="time-scope" placeholder="开始 到 结束">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">用户名</label>
                        <div class="layui-input-block">
                            <input type="text" name="name" placeholder="请输入用户名" autocomplete="on" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">电话</label>
                        <div class="layui-input-block">
                            <input type="text" name="mobile" placeholder="请输入" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">状态</label>
                        <div class="layui-input-block">
                            <select name="state">
                                <option value="0">选择状态</option>
                                <option value="1">未激活</option>
                                <option value="2">已激活</option>
                                <option value="3">已删除</option>
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
                    <button class="layui-btn layuiadmin-btn-admin" data-type="add" data-title="添加老人信息" data-url="<?php echo url('user/oldForm'); ?>" data-width="90%" data-height="90%">添加</button>
                    <button class="layui-btn layuiadmin-btn-admin layui-btn-danger" data-type="del" data-url="<?php echo url('user/delOld'); ?>">删除</button>
                </div>
                <table id="list" lay-filter="list"></table>
                <script type="text/html" id="barDemo">
                    <a class="layui-btn layui-btn-xs" lay-event="other" data-title="编辑老人信息" data-url="<?php echo url('user/oldForm'); ?>" data-width="90%" data-height="90%">编辑</a>
                    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"  data-url="<?php echo url('user/delOld'); ?>">删除</a>
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
        var table = layui.table;

        //表格
        table.render({
            elem: '#list',
            url: "<?php echo url('admin/user/userList'); ?>", //数据接口
            title: '用户表',
            toolbar: 'true',
            defaultToolbar: ['filter', 'print', 'exports'],
            page: true,
            loading: true,
            limit: 20,
            limits: [10, 20, 50, 100],
            cols: [[{type: "checkbox", fixed: "left"},
                {field: "id", title: "ID",sort: true},
                {field: "username", title: "用户",sort: true},
                {field: "mobile", title: "手机号",sort: true},
                {field: "type", title: "类型",sort: true},
                {field: "resthome_count", title: "机构数量",sort: true},
                {field: "elder_count", title: "来人数量",sort: true},
                {field: "state", title: "状态",sort: true},
                {fixed: 'right', title: '操作',width: 165, align: 'center', toolbar: '#barDemo'}
                ]],
        });
    });
</script>
</body>
</html>