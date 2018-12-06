<?php /*a:1:{s:65:"D:\work\OpenEwei\application\admin\view\user\register_config.html";i:1542355213;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户注册配置</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
</head>
<body>

<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-header">用户注册配置</div>
        <div class="layui-card-body" style="padding: 15px;">
            <form class="layui-form" action="" lay-filter="component-form-group">
                <div class="layui-form-item">
                    <label class="layui-form-label">注册类型</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="register_type" value="normal" <?php if(in_array('normal', $config['register_type'])): ?>checked<?php endif; ?> title="普通注册">
                        <input type="checkbox" name="register_type" value="invite" <?php if(in_array('invite', $config['register_type'])): ?>checked<?php endif; ?> title="邀请注册">
                    </div>
                    <div class="layui-form-mid layui-word-aux">（勾选为开启）</div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">注册开关</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="reg_switch" value="email" <?php if(in_array('email', $config['reg_switch'])): ?>checked<?php endif; ?> title="邮箱">
                        <input type="checkbox" name="reg_switch" value="mobile" <?php if(in_array('mobile', $config['reg_switch'])): ?>checked<?php endif; ?> title="手机">
                    </div>
                    <div class="layui-form-mid layui-word-aux">（允许使用的注册选项,全不选即为关闭注册）</div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">邮箱验证类型</label>
                    <div class="layui-input-block">
                        <input type="radio" name="email_verify_type" value="0" <?php if($config['email_verify_type'] == 0): ?>checked<?php endif; ?> title="不验证">
                        <input type="radio" name="email_verify_type" value="1" <?php if($config['email_verify_type'] == 1): ?>checked<?php endif; ?> title="注册后发送激活邮件">
                        <input type="radio" name="email_verify_type" value="2" <?php if($config['email_verify_type'] == 2): ?>checked<?php endif; ?> title="注册前发送验证邮件">
                    </div>
                    <div class="layui-form-mid layui-word-aux">（邮箱验证的类型）</div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">手机验证类型</label>
                    <div class="layui-input-block">
                        <input type="radio" name="mobile_verify_type" value="0" <?php if($config['mobile_verify_type'] == 0): ?>checked<?php endif; ?> title="不验证">
                        <input type="radio" name="mobile_verify_type" value="1" <?php if($config['mobile_verify_type'] == 1): ?>checked<?php endif; ?> title="注册前发送验证短信">
                    </div>
                    <div class="layui-form-mid layui-word-aux">（手机验证的类型）</div>
                </div>
                <div class="layui-form-item layui-layout-admin">
                    <div class="layui-input-block">
                        <div class="layui-footer" style="left: 0;">
                            <button class="layui-btn" lay-submit="" lay-filter="component-form-demo">立即提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="/static/layuiadmin/layui/layui.js"></script>
<script>
    layui.config({
        base: '/static/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'form', 'laydate'], function(){
        var $ = layui.$
            ,admin = layui.admin
            ,element = layui.element
            ,layer = layui.layer
            ,form = layui.form;

        form.render(null, 'component-form-group');

        /* 监听提交 */
        form.on('submit(component-form-demo)', function(data){
            var register_type = [];
            $("input[name='register_type']:checked").each(function () {
                register_type.push(this.value);
            });
            var reg_switch = [];
            $("input[name='reg_switch']:checked").each(function () {
                reg_switch.push(this.value);
            });
            data.field.reg_switch = reg_switch;
            data.field.register_type = register_type;
            $.post("<?php echo url('admin/user/registerConfig'); ?>", {data: data.field}, function (res) {
                layer.msg(res.msg);
            }, 'json');
            return false;
        });
    });
</script>
</body>
</html>
