<?php /*a:1:{s:77:"D:\work\yanglao_admin_3\application\admin\view\resthome_statistics\index.html";i:1543651549;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>机构招聘管理</title>
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
                        <div class="layui-inline">
                            <label class="layui-form-label">类型</label>
                            <div class="layui-input-inline">
                                <select class="form-control m-b" name="type">
                                    <option value="">选择类型</option>
                                    <option value="1">养老院</option>
                                    <option value="2">敬老院</option>
                                    <option value="3">老年公寓</option>
                                    <option value="4">护理院</option>
                                    <option value="5">疗养院</option>
                                    <option value="6">养老照料中心</option>
                                    <option value="7">养老社区/CCRC</option>
                                    <option value="8">福利院</option>
                                    <option value="9">其他</option>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">性质</label>
                            <div class="layui-input-inline">
                                <select class="form-control m-b" name="nature">
                                    <option value="">选择性质</option>
                                    <option value="1">办公</option>
                                    <option value="2">民办</option>
                                    <option value="3">民办公助</option>
                                    <option value="4">公寓民营</option>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">推广等级</label>
                            <div class="layui-input-inline">
                                <select class="form-control m-b" name="statuss">
                                    <option value="">待认证</option>
                                    <option value="1">认证机构</option>
                                    <option value="2">推广合作</option>
                                    <option value="3">合作伙伴</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">机构名称</label>
                            <div class="layui-input-inline">
                                <input type="text" name="keyword" value="" placeholder="请输入关键词" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <button class="layui-btn layuiadmin-btn-useradmin" lay-submit lay-filter="LAY-search">
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
        //表格
        table.render({
            elem: '#list',
            url: "<?php echo url('ResthomeStatistics/index'); ?>", //数据接口
            title: '机构统计表',
            toolbar: 'true',
            defaultToolbar: ['filter', 'print', 'exports'],
            page: true,
            loading: true,
            limit: 20,
            limits: [10, 20, 50, 100],
            cols: [[
                {type: 'checkbox', fixed: 'left'},
                {field: 'id', title: 'ID', sort: true, fixed: 'left'},
                {field: 'resthome_name', title: '机构名称', sort: true},
                {field: 'resthome_short', title: '机构来电信息', sort: true},
                {field: 'resthome_slogen', title: '预约信息', sort: true},
                {field: 'resthome_hits', title: '试住信息', sort: true},
                {field: 'resthome_hits', title: '点击量', sort: true},
                {field: 'resthome_hits', title: '分享量', sort: true},
                {field: 'resthome_hits', title: '机构浏览时长', sort: true},
                {field: 'resthome_hits', title: '文章信息', sort: true},
                {field: 'resthome_hits', title: '评论量', sort: true},
                {field: 'resthome_hits', title: '收藏量', sort: true},
            ]]
        });
    });
</script>
</body>
</html>