<?php /*a:1:{s:61:"D:\work\OpenEwei\application\admin\view\admin\admin_form.html";i:1544111840;}*/ ?>
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
            <input type="hidden" name="id" value="<?php echo htmlentities($admin['id']); ?>" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-inline">
            <input type="text" name="username" value="<?php echo htmlentities($admin['username']); ?>" lay-verify="required" placeholder="请输入用户名"
                   autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">密码</label>
        <div class="layui-input-inline">
            <input type="password" name="password" value="" lay-verify="" placeholder="<?php if(isset($admin['password'])): ?>不修改密码请留空<?php else: ?>请输入密码<?php endif; ?>"
                   autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">电子邮箱</label>
        <div class="layui-input-inline">
            <input type="text" name="email" value="<?php echo htmlentities($admin['email']); ?>" lay-verify="required|email" placeholder="请输入电子邮箱"
                   autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">手机号</label>
        <div class="layui-input-inline">
            <input type="text" name="mobile" value="<?php echo htmlentities($admin['mobile']); ?>" lay-verify="required|phone" placeholder="请输入手机号"
                   autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">分组</label>
            <div class="layui-input-block" id="tag_ids1"></div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-block">
            <input type="checkbox"
                   <?php if(isset($admin['status']) && $admin['status']== 1): ?>checked<?php elseif(!isset($admin['status'])): ?>checked<?php else: endif; ?>
            name="status" lay-skin="switch" lay-filter="switchTest" lay-text="启用|禁用">
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

    layui.use(['selectM'], function () {
        var selectM = layui.selectM;
        var selected = "<?php echo htmlentities($admin['group_id']); ?>";
        selected = selected.split(",");
        var tagData = <?php echo $groupJson; ?>;
        //多选标签-基本配置
        var tagIns1 = selectM({
            //元素容器【必填】
            elem: '#tag_ids1'
            //候选数据【必填】
            ,data: tagData
            ,width:300
            //默认值
            ,selected: selected
            //input的name 不设置与选择器相同(去#.)
            ,name: 'group_id'
            //值的分隔符
            ,delimiter: ','
            //候选项数据的键名
            ,field: {idName:'id',titleName:'name'}
        });
    })

</script>
</body>
</html>