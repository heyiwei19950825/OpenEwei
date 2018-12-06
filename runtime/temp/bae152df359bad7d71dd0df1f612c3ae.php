<?php /*a:1:{s:64:"D:\work\yanglao_admin_3\application\admin\view\system\index.html";i:1542727368;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>添加文章</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
</head>
<body>
<div class="layui-form" lay-filter="layuiadmin-form" id="layuiadmin-form" style="padding: 20px 30px 0 0;">
    <input type="hidden" name="id" value="<?php echo htmlentities($data['id']); ?>">
    <div class="layui-form-item">
        <label class="layui-form-label">我的角色</label>
        <div class="layui-input-inline">
            <select name="role" lay-verify="">
                <option value="1" selected>超级管理员</option>
                <option value="2" disabled>普通管理员</option>
                <option value="3" disabled>审核员</option>
                <option value="4" disabled>编辑人员</option>
            </select>
        </div>
        <div class="layui-form-mid layui-word-aux">当前角色不可更改为其它角色</div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-inline">
            <input type="text" name="username" value="测试号" readonly class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux">不可修改。一般用于后台登入名</div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">昵称</label>
        <div class="layui-input-inline">
            <input type="text" name="nickname" value="测试" lay-verify="nickname" autocomplete="off" placeholder="请输入昵称" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">性别</label>
        <div class="layui-input-block">
            <input type="radio" name="sex" value="男" title="男">
            <input type="radio" name="sex" value="女" title="女" checked>
        </div>
    </div>
    <div class="layui-form-item">
         <label class="layui-form-label">头像</label>
         <div class="layui-input-inline">
           <input name="avatar" lay-verify="required" id="LAY_avatarSrc" placeholder="图片地址" value="http://cdn.layui.com/avatar/168.jpg" class="layui-input">
         </div>
         <div class="layui-input-inline layui-btn-container" style="width: auto;">
           <button type="button" class="layui-btn layui-btn-primary" id="LAY_avatarUpload">
             <i class="layui-icon">&#xe67c;</i>上传图片
           </button>
           <button class="layui-btn layui-btn-primary" layadmin-event="avartatPreview">查看图片</button >
         </div>
      </div>
    <div class="layui-form-item">
        <label class="layui-form-label">手机</label>
        <div class="layui-input-inline">
            <input type="text" name="cellphone" value="" lay-verify="phone" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">邮箱</label>
        <div class="layui-input-inline">
            <input type="text" name="email" value="" lay-verify="email" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">备注</label>
        <div class="layui-input-block">
            <textarea name="remarks" placeholder="请输入内容" class="layui-textarea"></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="setmyinfo">确认修改</button>
            <button type="reset" class="layui-btn layui-btn-primary">重新填写</button>
        </div>
    </div>
</div>
<script src="/static/layuiadmin/layui/layui.js"></script>
<script>
    layui.config({
        base: '/static/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'form','upload','layedit'], function(){
        var $ = layui.$
            ,form = layui.form
            ,layedit = layui.layedit
            ,upload = layui.upload;
        form.render();
        //普通图片上传
        var uploadInst = upload.render({
            elem: '#cover'
            ,url: '<?php echo url("file/uploadPicture"); ?>'
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#demo1').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                //如果上传失败
                if(res.code === -1){
                    $('#demoText').html('<span style="color: #FF5722;">'+res.msg+'</span>');
                    return ;
                }else{
                    $('#cover_id').val(res.id)
                }
                //上传成功
            }
            ,error: function(){
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function(){
                    uploadInst.upload();
                });
            }
        });
        //编辑器上传图片
        layedit.set({
            uploadImage: {
                url: '<?php echo url("File/uploadPicture"); ?>' //接口url
                ,type: 'POST' //默认post
            }
        });
        //编辑器
        var index=layedit.build('content');
        //自定义验证规则
        form.verify({
            content: function(){
                layedit.sync(index);
            },
            title :function (value) {
                if(value.length < 5 ){
                    return '标题至少得5个字符啊';
                }
            },
        });
        //监听状态操作
        form.on('switch(switchTest)', function(obj){
            if(obj.elem.checked){
                this.value = 1;
            }else{
                this.value = 0
            }
        });
    })
</script>
</body>
</html>