<?php /*a:1:{s:61:"D:\work\yanglao_admin_3\application\admin\view\adv\index.html";i:1543769711;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>广告管理</title>
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/oc.css" media="all">
</head>
<body>
<div class="layui-fluid">
    <div class="layui-tab layui-tab-card">
        <ul class="layui-tab-title">
            <li class="layui-this">广告管理</li>
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
                        <label class="layui-form-label">关键字</label>
                        <div class="layui-input-block">
                            <input type="text" name="name" placeholder="请输入广告名" autocomplete="on" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">位置</label>
                        <div class="layui-input-block">
                            <select name="sex">
                                <option value="">选择位置</option>
                                <option value="首页">首页</option>
                                <option value="旅居">旅居</option>
                                <option value="文章">文章</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">状态</label>
                        <div class="layui-input-block">
                            <select name="state">
                                <option value="">选择状态</option>
                                <option value="1">正常</option>
                                <option value="-1">已结束</option>
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
                    <button class="layui-btn layuiadmin-btn-admin" data-type="add" data-title="添加广告" data-url="<?php echo url('form'); ?>" data-width="60%" data-height="90%">添加</button>
                    <button class="layui-btn layuiadmin-btn-admin layui-btn-danger" data-type="del" data-url="<?php echo url('del'); ?>">删除</button>
                </div>
                <table id="list" lay-filter="list"></table>
                <script type="text/html" id="barDemo">
                    <a class="layui-btn layui-btn-xs" lay-event="other" data-title="修改状态" data-url="<?php echo url('update_status'); ?>" data-width="500px" data-height="50%">修改状态</a>
                    <a class="layui-btn layui-btn-xs" lay-event="other" data-title="编辑广告" data-url="<?php echo url('form'); ?>" data-width="60%" data-height="90%">编辑</a>
                    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"  data-url="<?php echo url('del'); ?>">删除</a>
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
            url: "<?php echo url('admin/adv/index'); ?>", //数据接口
            title: '广告表',
            toolbar: 'true',
            defaultToolbar: ['filter', 'print', 'exports'],
            page: true,
            loading: true,
            limit: 20,
            limits: [10, 20, 50, 100],
            cols: [[{type: "checkbox", fixed: "left"},
                {field: "id", title: "ID",sort: true},
                {field: "name", title: "名称",sort: true},
                {field: "position", title: "位置",sort: true},
                {field: "start_time", title: "开始时间",sort: true},
                {field: "end_time", title: "结束时间",sort: true},
                {field: "create_time", title: "创建时间",sort: true},
                {field: "views", title: "浏览次数",sort: true},
                {field: "sortorder", title: "排序",sort: true},
                {field: "flash", title: "是否flash",sort: true},
                {field: "state", title: "状态",sort: true},
                {fixed: 'right', title: '操作',width: 175, align: 'center', toolbar: '#barDemo'}
            ]],
        });
    });

</script>
</body>
</html>