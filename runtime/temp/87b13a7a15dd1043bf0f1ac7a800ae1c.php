<?php /*a:1:{s:57:"D:\work\OpenEwei\application\admin\view\adv\edit_pos.html";i:1542355213;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>广告位编辑弹窗</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
</head>
<body>

<div class="layui-form" lay-filter="layuiadmin-form" id="layuiadmin-form" style="padding: 20px 30px 0 0;">
    <input type="hidden" name="id" value="<?php echo htmlentities($adv['id']); ?>">
    <div class="layui-form-item">
        <label class="layui-form-label">标题</label>
        <div class="layui-input-inline">
            <input type="text" name="name" value="<?php echo htmlentities($adv['name']); ?>" lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">英文名</label>
        <div class="layui-input-block">
            <input type="text" name="title" value="<?php echo htmlentities($adv['title']); ?>" lay-verify="required" placeholder="请输入广告标识 （标识，同一个页面上不要出现两个同名的" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">路径</label>
        <div class="layui-input-block">
            <input type="text" name="path" value="<?php echo htmlentities($adv['path']); ?>" lay-verify="required" placeholder="请输入路径 （模块名/控制器名/方法名，例如：admin/Index/index）" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">广告类型</label>
        <div class="layui-input-inline">
            <select name="type">
                <option value="1">单图广告</option>
                <option value="2">多图轮播</option>
                <option value="3">文字链接</option>
                <option value="4">代码</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-inline">
            <select name="status">
                <option value="-1">删除</option>
                <option value="0">禁用</option>
                <option value="1" selected>启用</option>
                <option value="2">未审核</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">宽度</label>
        <div class="layui-input-block">
            <input type="text" name="width" value="<?php echo htmlentities($adv['width']); ?>" lay-verify="required" placeholder="请输入宽度 （支持各类长度单位，如px，em，%）" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">高度</label>
        <div class="layui-input-block">
            <input type="text" name="height" value="<?php echo htmlentities($adv['height']); ?>" lay-verify="required" placeholder="请输入高度 （支持各类长度单位，如px，em，%）" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">边缘留白</label>
        <div class="layui-input-block">
            <input type="text" name="margin" value="<?php echo htmlentities($adv['margin']); ?>" placeholder="边缘留白 （支持各类长度单位，如px，em，%；依次为：上 右 下 左，如 5px 2px 0 3px）" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">内部留白</label>
        <div class="layui-input-block">
            <input type="text" name="padding" value="<?php echo htmlentities($adv['padding']); ?>" placeholder="内部留白 （支持各类长度单位，如px，em，%；依次为：上 右 下 左，如 5px 2px 0 3px）" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item layui-hide">
        <input type="button" lay-submit lay-filter="LAY-submit" id="LAY-submit" value="确认">
    </div>
</div>

<script src="/static/layuiadmin/layui/layui.js"></script>
<script>
    layui.config({
        base: '/static/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'form'], function(){
        var $ = layui.$
            ,form = layui.form;
        $("select[name='type']").find("option[value='<?php echo htmlentities($adv['type']); ?>']").prop("selected",true);
        $("select[name='status']").find("option[value='<?php echo htmlentities($adv['status']); ?>']").prop("selected",true);
        form.render();
    })
</script>
</body>
</html>