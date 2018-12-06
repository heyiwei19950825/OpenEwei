<?php /*a:1:{s:65:"E:\RaningWork\OpenCenter\application\admin\view\resthome\pos.html";i:1543910951;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>广告管理列表</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/oc.css" media="all">
</head>
<body>
<div class="layui-fluid">
    <div class="layui-tab layui-tab-card">
        <ul class="layui-tab-title">
            <li class="layui-this">负责人变更审核</li>
            <li>状态审核</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div class="layui-form-item">
                    <label class="layui-form-label">机构名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="remark" autocomplete="off" class="layui-input" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">原负责人</label>
                    <div class="layui-input-inline">
                        <input type="text" name="remark" autocomplete="off" class="layui-input" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">原负责人联系方式</label>
                    <div class="layui-input-inline">
                        <input type="text" name="remark" autocomplete="off" class="layui-input" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">现负责人</label>
                    <div class="layui-input-inline">
                        <input type="text" name="remark" autocomplete="off" class="layui-input" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">现负责人联系方式</label>
                    <div class="layui-input-inline">
                        <input type="text" name="remark" autocomplete="off" class="layui-input" disabled>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">申请描述</label>
                    <div class="layui-input-inline">
                        <textarea placeholder="请输入内容" class="layui-textarea" disabled></textarea>
                    </div>
                </div>
                <div class="layui-form-item layui-hide">
                    <input type="button" lay-submit lay-filter="LAY-submit" id="LAY-submit" value="确认">
                </div>
            </div>
            <div class="layui-tab-item">
                <div class="layui-form-item">
                    <label class="layui-form-label">审核</label>
                    <div class="layui-input-inline">
                        <select name="state">
                            <option value="">选择状态</option>
                            <option value="1">待审核</option>
                            <option value="2">审核通过</option>
                            <option value="3">已认证</option>
                            <option value="4">合作推荐</option>
                            <option value="6">已删除</option>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">备注</label>
                    <div class="layui-input-inline">
                        <textarea placeholder="请输入内容" class="layui-textarea" disabled></textarea>
                    </div>
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
    }).use(['index', 'workorder', 'table'], function () {
        var $ = layui.$
            , form = layui.form
            , table = layui.table;

    });
</script>
</body>
</html>