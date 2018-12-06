<?php /*a:1:{s:61:"D:\work\yanglao_admin_3\application\admin\view\book\form.html";i:1543763886;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>预约编辑</title>
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
            <input type="hidden" name="id" value="<?php echo htmlentities($data['id']); ?>" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">老人人姓名</label>
        <div class="layui-input-inline">
            <input type="text" name="name" value="<?php echo htmlentities($data['name']); ?>" lay-verify="required" placeholder="请输入老人人姓名"
                   autocomplete="off" class="layui-input">
        </div>
        <label class="layui-form-label">老人人年龄</label>
        <div class="layui-input-inline">
            <input type="number" name="age" value="<?php echo htmlentities($data['age']); ?>" lay-verify="required|number" placeholder="请输入老人人年龄"
                   autocomplete="off" class="layui-input">
        </div>
        <label class="layui-form-label">性别</label>
        <div class="layui-input-inline">
            <select name="sex">
                <option value="0">选择性别</option>
                <option value="男"  <?php if($data['sex'] == '男'): ?>selected<?php endif; ?>>男</option>
                <option value="女"  <?php if($data['sex'] == '女'): ?>selected<?php endif; ?>>女</option>
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">预约时间</label>
        <div class="layui-input-inline">
            <input type="text" name="time" value="<?php echo htmlentities($data['time']); ?>" lay-verify="required|text" placeholder="yyyy-MM-dd HH:mm:ss" autocomplete="off" class="layui-input" id="time">
        </div>
        <label class="layui-form-label">机构</label>
        <div class="layui-input-inline">
            <input type="text" name="resthome" value="<?php echo htmlentities($data['resthome']); ?>" lay-verify="required|text" placeholder="机构" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">预约人</label>
        <div class="layui-input-inline">
            <input type="text" name="contact" value="<?php echo htmlentities($data['contact']); ?>" lay-verify="required|text" placeholder="请输入预约人姓名" autocomplete="off" class="layui-input">
        </div>
        <label class="layui-form-label">预约人电话</label>
        <div class="layui-input-inline">
            <input type="number" name="mobile" value="<?php echo htmlentities($data['mobile']); ?>" lay-verify="required|mobile" placeholder="请输入预约人电话" autocomplete="off" class="layui-input">
        </div>
        <label class="layui-form-label">与老人关系</label>
        <div class="layui-input-inline">
            <select class="form-control m-b" name="relation">
                <option value="">选择关系</option>
                <?php if(is_array($dict['elder_relation']) || $dict['elder_relation'] instanceof \think\Collection || $dict['elder_relation'] instanceof \think\Paginator): if( count($dict['elder_relation'])==0 ) : echo "" ;else: foreach($dict['elder_relation'] as $key=>$rvo): ?>
                <option value="<?php echo htmlentities($rvo['id']); ?>" <?php if($data['relation'] == $rvo['id']): ?>selected<?php endif; ?>><?php echo htmlentities($rvo['name']); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">预约状态</label>
        <div class="layui-input-inline">
            <select name="service_status">
                <option value="">选择预约状态</option>
                <option value="1" <?php if($data['state'] == '1'): ?>selected<?php endif; ?>>正常</option>
                <option value="-1" <?php if($data['state'] == '-1'): ?>selected<?php endif; ?>>已结束</option>
            </select>
        </div>
        <label class="layui-form-label">预约阶段</label>
        <div class="layui-input-inline">
            <select name="service_phase">
                <option value="">选择预约阶段</option>
                <option value="1" <?php if($data['state'] == '1'): ?>selected<?php endif; ?>>正在沟通</option>
                <option value="-1" <?php if($data['state'] == '-1'): ?>selected<?php endif; ?>>已沟通</option>
            </select>
        </div>
        <label class="layui-form-label">备注</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="remark" value="<?php echo htmlentities($data['remark']); ?>">
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
    }).use(['index', 'form','laydate'],function() {
        var $ = layui.jquery
            ,laydate = layui.laydate;


        //日期时间选择器
        laydate.render({
            elem: '#time'
            ,type: 'datetime'
        });
    });

</script>
</body>
</html>