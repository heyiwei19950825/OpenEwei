<?php /*a:1:{s:66:"D:\work\yanglao_admin_3\application\admin\view\resthome\audit.html";i:1543471577;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>管理员编辑</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
</head>
<body>
<form class="layui-form" action="" method="post" lay-filter="admin-form">
    <div class="layui-form-item">
        <div class="layui-input-inline">
            <input type="hidden" name="id" value="{id}" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">审核</label>
        <div class="layui-input-inline">
                <select class="form-control m-b" name="state">
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
            <input type="text" name="remark"  placeholder="请输入备注"
                   autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item layui-hide">
        <input type="button" lay-submit lay-filter="LAY-submit" id="LAY-submit" value="确认">
    </div>
</form>

<script src="/static/layuiadmin/layui/layui.js"></script>
<script>
    layui.config({
        base: '/static/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index', //主入口模块
        selectM: 'lib/extend/selectM'
    }).use(['index', 'form', 'selectM'],function() {
        var $ = layui.jquery,
            form = layui.form;
    });

</script>
</body>
</html>