<?php /*a:1:{s:60:"D:\work\OpenEwei\application\admin\view\score\type_form.html";i:1542355213;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>积分类型编辑</title>
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
            <input type="hidden" name="id" value="<?php echo htmlentities($type['id']); ?>" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">积分名称</label>
        <div class="layui-input-inline">
            <input type="text" name="title" value="<?php echo htmlentities($type['title']); ?>" lay-verify="required" placeholder="请输入名称"
                   autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">积分单位</label>
        <div class="layui-input-inline">
            <input type="text" name="unit" value="<?php echo htmlentities($type['unit']); ?>" lay-verify="required" placeholder="请输入单位"
                   autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">积分说明</label>
        <div class="layui-input-inline">
            <input type="text" name="intro" value="<?php echo htmlentities($type['intro']); ?>" lay-verify="" placeholder="请输入说明"
                   autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-block">
            <input type="checkbox"
                   <?php if(isset($type['status']) && $type['status']== 1): ?>checked<?php elseif(!isset($type['status'])): ?>checked<?php else: endif; ?>
            name="status" lay-skin="switch" lay-filter="switchTest" lay-text="启用|禁用">
        </div>
    </div>
    <div class="layui-form-item layui-hide">
        <input type="button" lay-submit lay-filter="LAY-user-front-submit" id="LAY-user-front-submit" value="确认">
    </div>
</form>

<script src="/static/layuiadmin/layui/layui.js"></script>
<script>
    layui.config({
        base: '/static/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index', //主入口模块
    }).use(['index', 'form'],function() {
        var $ = layui.jquery,
            form = layui.form;
    });
</script>
</body>
</html>