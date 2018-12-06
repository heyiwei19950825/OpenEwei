<?php /*a:1:{s:76:"D:\work\yanglao_admin_3\application\admin\view\article_statistics\index.html";i:1543765941;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>试住管理</title>
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
                            <label class="layui-form-label">文章状态</label>
                            <div class="layui-input-inline">
                                <select class="form-control m-b" name="statuss">
                                    <option value="">选择状态</option>
                                    <option value="1">审核通过</option>
                                    <option value="2">未审核</option>
                                    <option value="3">未通过</option>
                                    <option value="4">异常</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">作者</label>
                            <div class="layui-input-inline">
                                <input type="text" name="keyword" value="" placeholder="请输入作者" class="layui-input">
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
                <table id="list" lay-filter="list"></table>
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
            url: "<?php echo url('articleStatistics/index'); ?>", //数据接口
            title: '文章统计表',
            toolbar: 'true',
            defaultToolbar: ['filter', 'print', 'exports'],
            page: true,
            loading: true,
            limit: 20,
            limits: [10, 20, 50, 100],
            cols: [[
                {type: 'checkbox', fixed: 'left'},
                {field: 'id', title: 'ID', sort: true, fixed: 'left'},
                {field: 'article_title', title: '文章标题', sort: true},
                {field: 'article_type', title: '文章类型', sort: true},
                {field: 'article_des', title: '描述', sort: true},
                {field: 'article_keywords', title: '关键字', sort: true},
                {field: 'article_hits', title: '点击量', sort: true},
                {field: 'article_comments', title: '评论数', sort: true},
                {field: 'article_phase', title: '分享量', sort: true},
                {field: 'article_status', title: '文章等级', sort: true},
                {field: 'article_remake', title: '备注', sort: true},
            ]]
        });
    });
</script>
</body>
</html>