<?php /*a:1:{s:63:"D:\work\yanglao_admin_3\application\admin\view\login\login.html";i:1543152008;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登入</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/login.css" media="all">
</head>
<body id="web_bg">

<div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">
    <div class="layadmin-user-login-main">
        <div class="layadmin-user-login-box layadmin-user-login-header">
            <h2 style="color: #fff;">春树养老后台管理系统</h2>
        </div>
        <form class="layadmin-user-login-box layadmin-user-login-body layui-form">
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-username"
                       for="LAY-user-login-username"></label>
                <input type="text" name="username" id="LAY-user-login-username" lay-verify="required" placeholder="用户名"
                       class="layui-input">
            </div>
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-password"
                       for="LAY-user-login-password"></label>
                <input type="password" name="password" id="LAY-user-login-password" lay-verify="required"
                       placeholder="密码" class="layui-input">
            </div>
            <?php if($captcha): ?>
            <div class="layui-form-item">
                <div class="layui-row">
                    <div class="layui-col-xs7">
                        <label class="layadmin-user-login-icon layui-icon layui-icon-vercode"
                               for="LAY-user-login-vercode"></label>
                        <input type="text" name="vercode" id="LAY-user-login-vercode" lay-verify="required"
                               placeholder="图形验证码" class="layui-input">
                    </div>
                    <div class="layui-col-xs5">
                        <div style="margin-left: 10px;">
                            <img src="<?php echo captcha_src(); ?>" class="layadmin-user-login-codeimg">
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="layui-form-item" style="margin-bottom: 20px;">
                <input type="checkbox" name="remember" checked lay-skin="primary" title="记住密码">
            </div>
            <div class="layui-form-item">
                <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="LAY-user-login-submit">登 入</button>
            </div>
        </form>
    </div>

    <div class="layui-trans layadmin-user-login-footer">

        <p>© 2018 <a href="http://www.ocenter.cn/" target="_blank">ocenter.cn</a></p>
        <p>
        </p>
    </div>

</div>

<script src="/static/layuiadmin/layui/layui.js"></script>
<script>
    layui.config({
        base: '/static/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'user', 'jquery'], function () {
        var $ = layui.$
            , setter = layui.setter
            , admin = layui.admin
            , form = layui.form
            , router = layui.router()
            , search = router.search;

        form.render();

        function updateCaptcha() {
            $('.layadmin-user-login-codeimg').attr('src', ("<?php echo url('admin/login/updateCaptcha'); ?>" + '?t=' + new Date().getTime()));
        }

        //点击更新验证码
        $('.layadmin-user-login-codeimg').on('click', function() {
            this.src = ("<?php echo url('admin/login/updateCaptcha'); ?>" + '?t=' + new Date().getTime());
        });

        //监听提交
        form.on('submit(LAY-user-login-submit)', function (data) {
            var field = data.field;
            $.post("<?php echo url('admin/login/login'); ?>", {data: field}, function (res) {
                console.log(res);
                if (res.code === 1) {
                    layer.msg(res.msg);
                    setTimeout(function () {
                        $(location).attr('href', res.url);
                    }, 1000);
                } else {
                    layer.msg(res.msg);
                    updateCaptcha();
                }
            }, 'json');
            return false;
        });
    });
</script>
</body>
</html>