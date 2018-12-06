<?php /*a:1:{s:75:"D:\work\yanglao_admin_3\application\admin\view\resthome_feedback\reply.html";i:1543770395;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>回复</title>
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
        <label class="layui-form-label">回复内容</label>
        <div class="layui-input-inline">
            <textarea name="summary" placeholder="请输入回复内容" class="layui-textarea" style="width: 300px;"></textarea>
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