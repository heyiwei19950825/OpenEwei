<?php /*a:1:{s:65:"D:\work\yanglao_admin_3\application\admin\view\article\index.html";i:1543770006;}*/ ?>
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
                            <button class="layui-btn layuiadmin-btn-useradmin" lay-submit lay-filter="LAY-search">
                                <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="layui-tab-item layui-show">
                    <div style="padding: 10px;">
                        <button class="layui-btn layuiadmin-btn-admin" data-type="add" data-title="添加文章" data-url="<?php echo url('form'); ?>" data-width="90%" data-height="90%">添加</button>
                        <button class="layui-btn layuiadmin-btn-admin layui-btn-danger" data-type="del" data-url="<?php echo url('del'); ?>">删除</button>
                    </div>
                    <table id="list" lay-filter="list"></table>
                    <script type="text/html" id="barDemo">
                        <a class="layui-btn layui-btn-xs" lay-event="other" data-title="修改状态" data-url="<?php echo url('update_status'); ?>" data-width="500px" data-height="50%">修改状态</a>
                        <a class="layui-btn layui-btn-xs" lay-event="other" data-title="编辑文章" data-url="<?php echo url('form'); ?>" data-width="90%" data-height="90%">编辑</a>
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
            url: "<?php echo url('article/index'); ?>", //数据接口
            title: '文章表',
            toolbar: 'true',
            defaultToolbar: ['filter', 'print', 'exports'],
            page: true,
            loading: true,
            limit: 20,
            limits: [10, 20, 50, 100],
            cols: [[
                {type: 'checkbox', fixed: 'left'},
                {field: 'id', title: 'ID', sort: true, fixed: 'left'},
                {field: 'title', title: '文章标题', sort: true},
                {field: 'comments', title: '评论数', sort: true},
                {field: 'share', title: '分享数', sort: true},
                {field: 'thumbsup', title: '点赞数', sort: true},
                {field: 'create_time', title: '创建时间', sort: true},
                {fixed: 'right', title: '操作',width: 175, align: 'center', toolbar: '#barDemo'}
            ]]
        });
    });
</script>
</body>
</html>